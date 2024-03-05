<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use App\Domain\Blog\Models\Series;
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

        if (is_null($updateBlogRequest->input('series_id')) && $blog->series_id) {
            // remove blog from old series
            app(RemoveBlogFromSeriesAction::class)($blog, Series::whereId($blog->series_id)->first());

//            $newSeriesModel = Series::whereId($series)->first();
//
//            $newSeriesModel->blogs()->attach($blog->id, [
//                'order' => $newSeriesModel->nextOrder()
//            ]);
//
//            $blog->update([
//                'series_id' => $newSeriesModel->id
//            ]);
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
                if (! $blog->published_at) {
                    $blog->update([
                        'published_at' => now()
                    ]);
                }
            }
        }

        return $blog;
    }
}
