<?php

namespace App\Domain\Blog\Policies;

use App\Domain\Iam\Models\User;

class SeriesPolicy
{
    public function manage(User $user): bool
    {
        if ($user->hasRole(User::ROLE_ADMIN)) {
            return true;
        }

        return false;
    }
}
