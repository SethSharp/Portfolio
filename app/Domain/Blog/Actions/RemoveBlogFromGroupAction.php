<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Group;

class RemoveBlogFromGroupAction
{
    public function __invoke(Blog $blogToRemove, Group $oldGroup): void
    {
        // remove from pivot
        $originalOrder = $oldGroup->blogs()->where('blog_id', $blogToRemove->id)->first();

        if (is_null($originalOrder)) {
            throw new \Exception("Blog " . $blogToRemove->title . " does not exist in group " . $oldGroup->title);
        }

        /**
         * blog - 1
         * blog - removed
         * blog - 3
         * blog -4
         *
         * We need to move the order of blogs in positions 3 and 4 down one
         *
         * This logic will get item with the order above the old
         */

        $blogs = $oldGroup->blogs()->where('order', '>', $originalOrder->pivot->order)->get();

        $count = $originalOrder->pivot->order;

        foreach ($blogs as $blog) {
            $oldGroup->blogs()->updateExistingPivot($blog->id, [
                'order' => $count
            ]);

            $count = $count + 1;
        }

        // remove old pivot
        $oldGroup->blogs()->detach($blogToRemove->id);
    }
}
