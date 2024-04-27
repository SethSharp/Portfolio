<?php

namespace App\Console\Commands\Bootstrap;

use App\Http\EnvironmentEnum;
use Illuminate\Console\Command;
use SethSharp\BlogCrud\Models\Iam\User;

class FixThings extends Command
{
    protected $signature = 'fix:things';
    protected $description = 'Adds a admin/author user to bethany environment';

    public function handle(): void
    {
        if (config('environment.current') === EnvironmentEnum::BETH->value) {
            User::factory()->admin()->create([
                'name' => 'Bethany Frankis',
                'email' => 'b.frankis@outlook.com',
            ]);

            User::factory()->author()->create([
                'name' => 'Seth Sharp',
                'email' => 'sesharp@outlook.com',
            ]);
        }
    }
}
