<?php

namespace App\Support\Filters;

use App\Domain\Blog\Enums\TagStatus;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TagStatusFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        match ($value) {
            TagStatus::ACTIVE->value => $query->whereNull('deleted_at'),
            TagStatus::DELETED->value => $query->whereNotNull('deleted_at')->withTrashed(),
        };
    }
}
