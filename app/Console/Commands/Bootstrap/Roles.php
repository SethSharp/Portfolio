<?php

namespace App\Console\Commands\Bootstrap;

use Illuminate\Console\Command;
use App\Domain\Iam\Actions\SyncRolesAction;

class Roles extends Command
{
    protected $signature = 'bootstrap:roles';
    protected $description = 'Set up roles.';

    public function handle(SyncRolesAction $action): void
    {
        $this->line('bootstrapping roles...');
        $action();
    }
}
