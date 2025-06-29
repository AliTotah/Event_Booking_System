<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'booking_date' => now(),
            'num_tickets' => fake()->numberBetween(1, 5),
            'total_price' => fake()->randomFloat(2, 50, 300),
            'status' => 'pending',
        ];
    }
}