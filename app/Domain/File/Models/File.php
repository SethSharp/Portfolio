<?php

namespace App\Domain\File\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class File extends Model
{
    protected $guarded = [];

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => $this?->path ? Storage::disk('s3')->url($this->path) : null
        );
    }
}
