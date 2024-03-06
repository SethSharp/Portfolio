<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use App\Domain\Blog\Models\Group;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

class UpdateBlogAction
{
    public function __invoke(Blog $blog, UpdateBlogRequest $updateBlogRequest): Blog
    {
        if ($updateBlogRequest->has('slug')) {
            $slug = Str::slug($updateBlogRequest->input('slug'));
        } else {
            $slug = Str::slug($updateBlogRequest->input('title'));
        }

        $blog->update([
            ...$updateBlogRequest->validated(),
            'slug' => $slug,
        ]);

        if ($tags = $updateBlogRequest->input('tags')) {
            $tags = collect($tags)->pluck('id');

            $blog->tags()->sync($tags);
        }

        if (is_null($updateBlogRequest->input('group_id')) && $blog->group_id) {
            app(RemoveBlogFromGroupAction::class)($blog, Group::whereId($blog->group_id)->first());

            $blog->update([
                'group_id' => null
            ]);
        } elseif ($updateBlogRequest->input('group_id') && is_null($blog->group_id)) {
            $group = $updateBlogRequest->input('group_id');

            app(AddBlogToGroupAction::class)($blog, Group::whereId($group)->first());

            $blog->update([
                'group_id' => $group
            ]);
        }

        $blog = app(CleanBlogContentAction::class)($blog);

        Cache::forget(CacheKeys::renderedBlogContent($blog));

        $blog->render();

        if ($updateBlogRequest->has('is_draft')) {
            if ($updateBlogRequest->input('is_draft')) {
                $blog->update([
                    'published_at' => null
                ]);
            } else {
                if (!$blog->published_at) {
                    $blog->update([
                        'published_at' => now()
                    ]);
                }
            }
        }

        return $blog;
    }
}
