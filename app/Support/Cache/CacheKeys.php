<?php

namespace App\Support\Cache;

use App\Domain\Blog\Models\Blog;

class CacheKeys
{
    public static function renderedBlogContent(Blog $blog): string
    {
        return 'blog-' . $blog->id . '-rendered-content';
    }
}
