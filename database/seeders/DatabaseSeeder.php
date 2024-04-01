<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Console\Commands\Bootstrap;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Iam\User;
use SethSharp\BlogCrud\Models\Blog\Blog;

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
            'name' => 'Laravel'
        ]);

        Tag::factory()->create([
            'name' => 'AWS'
        ]);

        Tag::factory()->create([
            'name' => 'Discussion'
        ]);

        Tag::factory()->create([
            'name' => 'Tutorial'
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
