<?php

namespace App\Domain\Iam\Actions;

use App\Domain\Iam\Models\Role;
use App\Domain\Iam\Models\User;

class SyncRolesAction
{
    public function __invoke(): void
    {
        $roles = [
            User::ROLE_ADMIN,
            User::ROLE_AUTHOR,
        ];

        foreach ($roles as $role) {
            if (! Role::where('name', $role)->exists()) {
                Role::create(['name' => $role]);
            }
        }
    }
}
