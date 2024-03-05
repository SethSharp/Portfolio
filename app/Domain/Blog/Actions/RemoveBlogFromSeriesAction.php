<?php

namespace App\Domain\Blog\Actions;

use App\Domain\Blog\Models\Blog;
use App\Domain\Blog\Models\Series;

class RemoveBlogFromSeriesAction
{
    public function __invoke(Blog $blog, Series $oldSeries): void
    {
        // remove from pivot
        $originalOrder = $oldSeries->blogs()->where('blog_id', $blog->id)->first();//->pivot->order;
        dd($originalOrder);
        //        $oldSeries->blogs()->detach($blog->id);

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

        dd($originalOrder);
        $blogs = $oldSeries->blogs()->where('order', '>', $originalOrder)->get();
        dd($blogs);
    }
}
