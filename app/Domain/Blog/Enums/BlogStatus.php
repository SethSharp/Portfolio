<?php

namespace App\Domain\Blog\Enums;

use App\Support\Traits\Enumerable;

enum BlogStatus: string
{
    use Enumerable;
    
    case PUBLISHED = 'published';
    case DRAFTED = 'drafted';
    case DELETED = 'deleted';
}
