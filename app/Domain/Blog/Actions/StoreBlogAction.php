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

        return Blog::create([
            'author_id' => auth()->user()->id,
            ...$storeBlogRequest->validated(),
        ]);
    }
}
