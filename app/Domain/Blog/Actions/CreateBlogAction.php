<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use Illuminate\Support\Facades\Cache;
use App\Domain\Blog\Models\Collection;
use App\Domain\File\Actions\StoreBlogCoverAction;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

class CreateBlogAction
{
    public function __invoke(): Blog
    {
        return Blog::create([
            'author_id' => auth()->user()->id,
            'slug' => 'this-is-my-blog',
            'title' => 'This is my blog!',
            'content' => '',
            'is_draft' => true,
        ]);
    }
}
