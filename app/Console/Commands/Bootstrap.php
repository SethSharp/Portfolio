<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Domain\Iam\Models\Role;
use App\Domain\Iam\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Console\Commands\Bootstrap\Roles;

class Bootstrap extends Command
{
    protected $signature = 'bootstrap';
    protected $description = 'Bootstrap all';

    public function handle(): void
    {
        $this->info("Bootstrapping...");

        $this->call(Roles::class);

        $user = User::create([
            'name' => 'Seth Sharp',
            'email' => 'sesharp@outlook.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

        $admin = Role::whereName(User::ROLE_ADMIN)->first();
        $user->roles()->attach([$admin->id]);
    }
}
