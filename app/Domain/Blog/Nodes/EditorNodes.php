<?php

namespace App\Domain\Blog\Nodes;

use App\Support\Editor\Components;
use App\Support\Editor\Nodes\Image;

class EditorNodes extends Components
{
    public static array $components = [
        Image::class,
    ];
}
