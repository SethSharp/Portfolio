<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\Bootstrap\Roles;
use App\Domain\Workspace\Models\Workspace;
use App\Console\Commands\Bootstrap\Workflows;
use App\Domain\Workspace\Enums\WorkspaceType;
use App\Console\Commands\Bootstrap\Permissions;
use App\Console\Commands\Bootstrap\FileCategories;
use App\Console\Commands\Bootstrap\RolePermissions;
use App\Console\Commands\Bootstrap\Specialisations;
use App\Console\Commands\Bootstrap\WorkflowTriggers;
use App\Domain\Aviation\Casa\Commands\BootstrapCasa;
use Spatie\Multitenancy\Commands\Concerns\TenantAware;

class Bootstrap extends Command
{
    protected $signature = 'bootstrap';
    protected $description = 'Bootstrap all';

    public function handle(): void
    {
        $this->info("Bootstrapping...");

        $this->call(Roles::class);
    }
}
