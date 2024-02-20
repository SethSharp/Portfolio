<?php

namespace Tests\Traits;

use App\Domain\Iam\Actions\SyncRolesAction;

trait SeedsRoles
{
    public function seedRoles(): void
    {
        app(SyncRolesAction::class)();
    }
}
