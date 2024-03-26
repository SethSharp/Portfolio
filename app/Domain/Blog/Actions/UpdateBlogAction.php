<?php

namespace App\Domain\Blog\Actions;

use App\Domain\File\Actions\StoreBlogCoverAction;
use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use Illuminate\Support\Facades\Cache;
use App\Domain\Blog\Models\Collection;
use App\Domain\File\Actions\StoreFileAction;
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

        if (is_null($updateBlogRequest->input('collection_id')) && $blog->collection_id) {
            app(RemoveBlogFromCollectionAction::class)($blog, Collection::whereId($blog->collection_id)->first());

            $blog->update([
                'collection_id' => null
            ]);
        } elseif ($updateBlogRequest->input('collection_id') && is_null($blog->collection_id)) {
            $collection = $updateBlogRequest->input('collection_id');

            app(AddBlogToCollectionAction::class)($blog, Collection::whereId($collection)->first());

            $blog->update([
                'collection_id' => $collection
            ]);
        }

        if ($coverImage = $updateBlogRequest->file('cover_image')) {
            $coverImagePath = app(StoreBlogCoverAction::class)($coverImage, $blog->id, '/cover-images/');

            $blog->update([
                'cover_image' => $coverImagePath
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
