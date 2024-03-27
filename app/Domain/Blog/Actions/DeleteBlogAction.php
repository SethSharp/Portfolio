<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;

class DeleteBlogAction
{
    public function __invoke(Blog $blog): void
    {
        $blog->delete();
    }
}
