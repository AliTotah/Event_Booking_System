<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventCrudController extends Controller
{
    public function index()
    {
        return view('admin.events.index', ['events' => Event::latest()->get()]);
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', 'location' => 'required',
            'date' => 'required|date', 'time' => 'required',
            'price' => 'required|numeric'
        ]);
        Event::create($request->all());
        return redirect()->route('admin.events.index')->with('success', 'تم إضافة الفعالية بنجاح.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('admin.events.index')->with('success', 'تم التحديث.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'تم الحذف.');
    }
}
