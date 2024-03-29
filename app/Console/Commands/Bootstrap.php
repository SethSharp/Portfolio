<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\Bootstrap\Roles;

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
