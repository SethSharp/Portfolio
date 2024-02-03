<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

class UpdateBlogAction
{
    public function __invoke(Blog $blog, UpdateBlogRequest $updateBlogRequest): Blog
    {
        $updateBlogRequest['slug'] = Str::slug($updateBlogRequest->input('slug'));

        $blog->update([
            ...$updateBlogRequest->validated(),
        ]);

        return $blog;
    }
}
