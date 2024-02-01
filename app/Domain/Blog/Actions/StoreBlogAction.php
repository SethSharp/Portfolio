<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Http\Requests\Dashboard\Blogs\StoreBlogRequest;

class StoreBlogAction
{
    public function __invoke(StoreBlogRequest $storeBlogRequest): Blog
    {
        return Blog::create([
            'title' => $storeBlogRequest->input('title'),
            'slug' => Str::slug($storeBlogRequest->input('slug')),
            'content' => $storeBlogRequest->input('content'),
            'is_draft' => false
        ]);
    }
}
