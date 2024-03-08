<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Collection;

class AddBlogToCollectionAction
{
    public function __invoke(Blog $blog, Collection $collection): void
    {
        $order = $collection->blogs()->count();

        $collection->blogs()->attach($blog, [
            'order' => $order + 1
        ]);
    }
}
