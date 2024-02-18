<?php

namespace App\Domain\Iam\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Codinglabs\Roles\HasRoles;
use App\Domain\Blog\Models\Blog;
use Laravel\Sanctum\HasApiTokens;
use App\Domain\Blog\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ROLE_ADMIN = 'admin';
    const ROLE_AUTHOR = 'author';

    public function blog(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comments')
            ->withTimestamps();
    }

    public function likedBlogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_likes', 'user_id', 'blog_id');
    }
}
