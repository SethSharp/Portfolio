<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;

class AddBlogToGroupAction
{
    public function __invoke(Blog $blog, Group $group): void
    {
        $order = $group->blogs()->count();

        $group->blogs()->attach($blog, [
            'order' => $order + 1
        ]);
    }
}
