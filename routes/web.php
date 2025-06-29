<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use App\Http\Controllers\Admin\EventCrudController;
use App\Http\Controllers\Admin\SeatCrudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/', function () {
    $events = Event::latest()->get();
    return view('home', compact('events'));
})->name('home');

Route::get('/events/{id}', function ($id) {
    $event = Event::findOrFail($id);
    return view('events.show', compact('event'));
})->name('events.show');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'eventsCount' => Event::count(),
            'bookingsCount' => Booking::count(),
            'paymentsCount' => Payment::count(),
            'latestBookings' => Booking::latest()->take(5)->get()
        ]);
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', function () {
        $bookings = auth()->user()->User::bookings()->with('event')->latest()->get();
        return view('user.bookings', compact('bookings'));
    })->name('user.bookings');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventCrudController::class)->except(['show']);
    Route::get('events/{event}/seats', [SeatCrudController::class, 'index'])->name('events.seats.index');
    Route::post('events/{event}/seats', [SeatCrudController::class, 'store'])->name('events.seats.store');
    Route::delete('seats/{seat}', [SeatCrudController::class, 'destroy'])->name('seats.destroy');
});