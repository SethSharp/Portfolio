<?php

namespace App\Support\Editor;

abstract class Node
{
    public string $prefix = 'tt';
    protected string $tag;

    abstract public static function buildHtmlTag(): string;

}
