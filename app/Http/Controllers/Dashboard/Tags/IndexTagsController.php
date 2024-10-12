<?php

namespace App\Http\Controllers\Dashboard\Tags;

use Inertia\Inertia;
use Inertia\Response;
use App\Domain\Blog\Enums\TagStatus;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use SethSharp\BlogCrud\Models\Blog\Tag;
use App\Support\Filters\TagStatusFilter;

class IndexTagsController extends Controller
{
    public function __invoke(): Response
    {
        $this->authorize('view', Tag::class);

        return Inertia::render('Dashboard/Tags/Index', [
            'tags' => QueryBuilder::for(Tag::class)
                ->allowedFilters([
                    AllowedFilter::custom('status', new TagStatusFilter())->default(TagStatus::ACTIVE->value)
                ])
                ->defaultSort('-created_at')
                ->paginate(10)
                ->withQueryString(),
            'currentStatus' => TagStatus::from(request()->input('filter.status', TagStatus::ACTIVE->value))->label(),
        ]);
    }
}
