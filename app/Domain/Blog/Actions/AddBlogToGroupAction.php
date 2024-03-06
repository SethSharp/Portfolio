<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;

class AddBlogToGroupAction
{
    public function __invoke(Blog $blog, Series $series): void
    {
    }
}
