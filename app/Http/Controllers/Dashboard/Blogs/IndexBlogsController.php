<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Enums\BlogStatus;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use SethSharp\BlogCrud\Models\Blog\Blog;
use App\Support\Filters\BlogSearchFilter;
use App\Support\Filters\BlogStatusFilter;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Blog::class);

        $currentStatus = BlogStatus::from(request()->input('filter.status',
            BlogStatus::PUBLISHED->value) ?? BlogStatus::PUBLISHED->value);

        return Inertia::render('Dashboard/Blogs/Index', [
            'blogs' => QueryBuilder::for(Blog::class)
                ->with(['tags', 'author', 'likes'])
                ->allowedFilters([
                    AllowedFilter::custom('status', new BlogStatusFilter())->default(BlogStatus::PUBLISHED->value),
                    AllowedFilter::custom('q', new BlogSearchFilter()),
                ])
                ->when($currentStatus->value === BlogStatus::PUBLISHED->value,
                    fn ($query) => $query->orderByDesc('published_at'))
                ->paginate(10),
            'status' => $currentStatus->label(),
        ]);
    }
}
