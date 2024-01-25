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
            'title' => $name,
            'slug' => $slug,
            'content' => fake()->text(),
            'status' => Blog::STATUS_DRAFT
        ];
    }
}
