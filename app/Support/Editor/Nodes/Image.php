<?php

namespace App\Support\Editor\Nodes;

use App\Support\Editor\Node;

class Image extends Node
{
    protected string $tag = 'image';

    public static function buildHtmlTag(): string
    {
        return self::$tag . self::$prefix;
    }
}
