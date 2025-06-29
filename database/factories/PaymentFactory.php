<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'payment_method' => fake()->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'transaction_id' => fake()->uuid(),
            'payment_date' => now(),
            'amount' => fake()->randomFloat(2, 50, 300),
            'status' => 'pending',
        ];
    }
}