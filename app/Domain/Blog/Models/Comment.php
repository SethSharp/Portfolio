<?php

namespace App\Domain\Blog\Models;

use App\Domain\Iam\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_comment', 'comment_id', 'blog_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id');
    }
}
