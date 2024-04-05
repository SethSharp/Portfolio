<?php

namespace App\Support\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BlogSearchFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): void
    {
        $query->where('title', 'LIKE', '%' . $value . '%');
    }
}
