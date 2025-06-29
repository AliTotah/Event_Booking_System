<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('seats')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'location' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required|numeric'
        ]);

        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        return $event->load('seats');
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}