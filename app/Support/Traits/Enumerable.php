<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait Enumerable
{
    public function label(): string
    {
        return __(Str::of($this->value)
            ->replace('_', ' ')
            ->title()
            ->__toString());
    }
}
