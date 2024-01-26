<?php

namespace Database\Seeders;

use App\Domain\Blog\Models\Tag;
use App\Domain\Iam\Models\User;
use Illuminate\Database\Seeder;
use App\Domain\Blog\Models\Blog;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@portfolio.test',
            'password' => Hash::make('123456')
        ]);

        $blog = Blog::factory()->create([
            'author_id' => $admin->id
        ]);

        $tag1 = Tag::factory()->create([
            'name' => 'Tutorial'
        ]);

        $tag2 = Tag::factory()->create([
            'name' => 'AWS'
        ]);

        $blog->tags()->syncWithoutDetaching([$tag1->id, $tag2->id]);
    }
}
