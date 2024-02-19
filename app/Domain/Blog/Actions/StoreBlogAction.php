<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogAction
{
    public function __invoke(StoreBlogRequest $storeBlogRequest): Blog
    {
        $storeBlogRequest['slug'] = Str::slug($storeBlogRequest->input('slug'));

        $tags = collect($storeBlogRequest->input('tags'))->pluck('id');

        $blog = Blog::create([
            'author_id' => auth()->user()->id,
            ...$storeBlogRequest->validated(),
        ]);

        $blog->tags()->sync($tags);

        $blog = app(CleanBlogContentAction::class)($blog);

        $blog->render();

        if (! $blog->isDraft()) {
            $blog->update([
                'published_at' => now()
            ]);
        }

        return $blog;
    }
}
