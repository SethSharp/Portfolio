<?php

namespace App\Domain\Blog\Actions;

use Illuminate\Support\Str;
use App\Domain\Blog\Models\Blog;
use App\Support\Cache\CacheKeys;
use Illuminate\Support\Facades\Cache;
use App\Domain\Blog\Models\Collection;
use App\Domain\File\Actions\StoreBlogCoverAction;
use App\Http\Requests\Dashboard\Blogs\UpdateBlogRequest;

class DeleteBlogAction
{
    public function __invoke(Blog $blog): void
    {
        $blog->delete();
    }
}
