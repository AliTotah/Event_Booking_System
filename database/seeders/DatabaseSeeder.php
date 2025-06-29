<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Seat;
use App\Models\Booking;
use App\Models\Payment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'phone' => '0500000000',
            'role' => 'admin'
        ]);

        // 10 مستخدمين
        User::factory(10)->create();

        // 5 أحداث
        Event::factory(5)->create()->each(function ($event) {
            // لكل حدث 20 مقعد
            Seat::factory(20)->create([
                'event_id' => $event->id
            ]);
        });

        // 20 حجز و 20 دفعة
        Booking::factory(20)->create()->each(function ($booking) {
            Payment::factory()->create([
                'booking_id' => $booking->id
            ]);
        });
    }
}