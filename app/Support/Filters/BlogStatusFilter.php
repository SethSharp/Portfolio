<?php

namespace App\Support\Filters;

use App\Domain\Blog\Enums\BlogStatus;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BlogStatusFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        match ($value) {
            BlogStatus::PUBLISHED->value => $query->published(),
            BlogStatus::DRAFTED->value => $query->notPublished(),
            BlogStatus::DELETED->value => $query->deleted(),
        };
    }
}
