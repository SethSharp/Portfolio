<?php

namespace App\Domain\Blog\Enums;

use App\Support\Traits\Enumerable;

enum TagStatus: string
{
    use Enumerable;

    case ACTIVE = 'active';
    case DELETED = 'deleted';
}
