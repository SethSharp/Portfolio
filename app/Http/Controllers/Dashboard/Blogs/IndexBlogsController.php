<?php

namespace App\Http\Controllers\Dashboard\Blogs;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Domain\Blog\Enums\BlogStatus;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use SethSharp\BlogCrud\Models\Blog\Blog;
use App\Support\Filters\BlogStatusFilter;

class IndexBlogsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Blog::class);

        $blogs = QueryBuilder::for(Blog::class)
            ->with(['tags', 'author', 'likes'])
            ->allowedFilters([
                AllowedFilter::custom('status', new BlogStatusFilter())->default(BlogStatus::PUBLISHED->value)
            ])
            ->defaultSort('-created_at')
            ->paginate(2)
            ->withQueryString();

        $currentStatus = BlogStatus::from(request()->input('filter.status', BlogStatus::PUBLISHED->value));

        return Inertia::render('Dashboard/Blogs/Index', [
            'blogs' => $blogs,
            'status' => $currentStatus->label(),
            'tabs' => collect(BlogStatus::cases())
                ->map(fn (BlogStatus $status) => [
                    'name' => $status->label(),
                    'active' => $status->value === $currentStatus->value,
                    'href' => route('dashboard.blogs.index', ['filter' => ['status' => $status->value]])
                ])
        ]);
    }
}
