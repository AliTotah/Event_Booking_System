<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Seat;

class SeatCrudController extends Controller
{
    public function index(Event $event)
    {
        $seats = $event->seats;
        return view('admin.seats.index', compact('event', 'seats'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'seat_number' => 'required|string',
            'status' => 'in:available,reserved,sold'
        ]);

        $event->seats()->create([
            'seat_number' => $request->seat_number,
            'status' => $request->status
        ]);

        return back()->with('success', 'تمت إضافة المقعد.');
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return back()->with('success', 'تم حذف المقعد.');
    }
}