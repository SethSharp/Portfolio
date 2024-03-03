<?php

namespace Database\Factories\Domain\Blog\Models;

use App\Domain\Blog\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeriesFactory extends Factory
{
    protected $model = Series::class;

    public function definition()
    {
        return [
            'title' => fake()->text(20),
            'description' => fake()->text(100),
        ];
    }
}
