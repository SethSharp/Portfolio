<?php

namespace App\Domain\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class)
            ->withPivot('order');
    }

    public function nextOrder(): int
    {
        return $this->blogs()->count() + 1;
    }
}
