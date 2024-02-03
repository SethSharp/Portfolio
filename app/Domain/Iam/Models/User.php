<?php

namespace App\Domain\Iam\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Codinglabs\Roles\HasRoles;
use App\Domain\Blog\Models\Blog;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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
}
