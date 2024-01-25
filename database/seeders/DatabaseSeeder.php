<?php

namespace Database\Seeders;

use App\Domain\Iam\Models\User;
use Illuminate\Database\Seeder;
use App\Domain\Blog\Models\Blog;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('123456')
        ]);

        Blog::factory()->create([
            'author_id' => $admin->id
        ]);
    }
}
