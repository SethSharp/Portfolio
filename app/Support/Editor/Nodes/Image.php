<?php

namespace App\Support\Editor\Nodes;

use App\Support\Editor\Node;

class Image extends Node
{
    protected static string $tag = 'image';

    public static function buildHtmlTag(): string
    {
        return self::$prefix . '-' . self::$tag;
    }

    public static function getReplaceTag(): string
    {
        return 'img';
    }
}
