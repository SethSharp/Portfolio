<?php

namespace App\Domain\Blog\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends \SethSharp\BlogCrud\Models\Blog\Blog
{
    use HasFactory;

    public function coverImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this?->cover_image ? Storage::disk('s3')->url($this->cover_image) : null
        );
    }
}
