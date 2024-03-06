<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;

class RemoveBlogFromSeriesAction
{
    public function __invoke(Blog $blogToRemove, Series $oldSeries): void
    {
        // remove from pivot
        $originalOrder = $oldSeries->blogs()->where('blog_id', $blogToRemove->id)->first();

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

        $blogs = $oldSeries->blogs()->where('order', '>', $originalOrder->pivot->order)->get();

        $count = $originalOrder->pivot->order;
        foreach ($blogs as $blog) {
            $oldSeries->blogs()->updateExistingPivot($blog->id, [
                'order' => $count
            ]);

            $count = $count + 1;
        }

        // remove old pivot
        $oldSeries->blogs()->detach($blogToRemove->id);
    }
}
