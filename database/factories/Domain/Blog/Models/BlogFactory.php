<?php

namespace Database\Factories\Domain\Blog\Models;

use Illuminate\Support\Str;
use App\Domain\Iam\Models\User;
use App\Domain\Blog\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        $name = fake()->name();
        $slug = Str::slug($name);

        return [
            'author_id' => User::factory()->create()->id,
            'is_draft' => false,
            'title' => $name,
            'slug' => $slug,
            'meta_title' => fake()->text(20),
            'meta_description' => fake()->text(100),
            'meta_tags' => fake()->text(10),
            'content' => fake()->text(),
        ];
    }
}
