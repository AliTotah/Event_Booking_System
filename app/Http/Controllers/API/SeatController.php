<?php

namespace App\Http\Controllers\API;

use App\Models\Seat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeatController extends Controller
{
    public function index()
    {
        return Seat::with('event')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'seat_number' => 'required',
            'status' => 'in:available,reserved,sold'
        ]);

        $seat = Seat::create($validated);
        return response()->json($seat, 201);
    }

    public function show(Seat $seat)
    {
        return $seat->load('event');
    }

    public function update(Request $request, Seat $seat)
    {
        $seat->update($request->all());
        return response()->json($seat);
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return response()->json(['message' => 'Seat deleted']);
    }
}
