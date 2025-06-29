<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

class SeatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'seat_number' => strtoupper(fake()->bothify('A##')),
            'status' => 'available',
        ];
    }
}
