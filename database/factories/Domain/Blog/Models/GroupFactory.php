<?php

namespace Database\Factories\Domain\Blog\Models;

use App\Domain\Blog\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'title' => fake()->text(20),
            'description' => fake()->text(100),
        ];
    }
}
