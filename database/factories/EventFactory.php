<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'date' => fake()->date(),
            'time' => fake()->time(),
            'price' => fake()->randomFloat(2, 10, 100),
        ];
    }
}