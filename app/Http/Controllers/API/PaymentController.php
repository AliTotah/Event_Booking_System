<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('booking')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'in:credit_card,paypal,bank_transfer',
            'transaction_id' => 'required|unique:payments,transaction_id',
            'amount' => 'required|numeric',
            'status' => 'in:completed,failed,pending'
        ]);

        $payment = Payment::create($validated);
        return response()->json($payment, 201);
    }

    public function show(Payment $payment)
    {
        return $payment->load('booking');
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());
        return response()->json($payment);
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(['message' => 'Payment deleted']);
    }
}
