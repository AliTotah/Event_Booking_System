<?php

namespace App\Http\Controllers\API;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::with(['user', 'event'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'num_tickets' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'status' => 'in:confirmed,pending,cancelled',
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        return $booking->load(['user', 'event']);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['message' => 'Booking deleted']);
    }
}