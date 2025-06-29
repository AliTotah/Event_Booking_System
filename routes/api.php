<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController as APIBookingController;
use App\Http\Controllers\API\EventController as APIEventController;
use App\Http\Controllers\API\PaymentController as APIPaymentController;
use App\Http\Controllers\API\SeatController as APISeatController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('events', APIEventController::class);
Route::apiResource('bookings', APIBookingController::class);
Route::apiResource('seats', APISeatController::class);
Route::apiResource('payments', APIPaymentController::class);


Route::apiResource('events', EventController::class);
Route::apiResource('seats', SeatController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('payments', PaymentController::class);


// تسجيل الدخول والتسجيل
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Routes محمية للمستخدمين المسجلين
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('events', EventController::class)->except(['destroy']);
    Route::apiResource('bookings', BookingController::class);
    Route::apiResource('payments', PaymentController::class);
    Route::apiResource('seats', SeatController::class);

    // Routes للمشرف فقط
    Route::middleware('admin')->group(function () {
        Route::delete('events/{event}', [EventController::class, 'destroy']);
        Route::delete('seats/{seat}', [SeatController::class, 'destroy']);
    });
});
