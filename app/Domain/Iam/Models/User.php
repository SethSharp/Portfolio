<?php

namespace App\Domain\Iam\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends \SethSharp\BlogCrud\Models\Iam\User
{
    use Notifiable;
    use HasApiTokens;

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
}
