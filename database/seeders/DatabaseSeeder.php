<?php

namespace Database\Seeders;

use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;
use Illuminate\Database\Seeder;
use App\Domain\Blog\Models\Blog;
use App\Console\Commands\Bootstrap;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Artisan::call(Bootstrap::class);

        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('123456')
        ]);

        Blog::factory()->count(10)->create([
            'author_id' => $admin->id
        ]);

        Tag::factory()->create([
            'name' => 'Tutorial'
        ]);

        Tag::factory()->create([
            'name' => 'AWS'
        ]);

        User::factory()->author()->create([
            'name' => 'Author',
            'email' => 'author@portfolio.test',
            'password' => Hash::make('123456')
        ]);

        $this->command->info('Seeding complete.');
        $this->command->info(Inspiring::quote());
    }
}
