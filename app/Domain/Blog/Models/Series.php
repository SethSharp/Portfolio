<?php

namespace App\Domain\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Series extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_series', 'series_id', 'blog_id')
            ->withPivotValue('order', 1);
    }

    public function nextOrder(): int
    {
        return $this->blogs()->count() + 1;
    }
}
