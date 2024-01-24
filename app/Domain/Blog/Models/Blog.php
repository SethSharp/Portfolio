<?php

namespace App\Domain\Blog\Models;

use App\Domain\Iam\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Blog extends Model
{
    use HasFactory;

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'author_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
