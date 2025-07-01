@extends('layouts.app')

@section('content')
    <h2>📦 حجوزاتي</h2>

    @if($bookings->isEmpty())
        <div class="alert alert-info">لا توجد حجوزات حتى الآن.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>الفعالية</th>
                    <th>المقعد</th>
                    <th>تاريخ الحجز</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event->title ?? 'غير معروفة' }}</td>
                        <td>{{ $booking->seat->seat_number ?? '-' }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @if($booking->payment_status === 'paid')
                                <span class="badge bg-success">مدفوع</span>
                            @else
                                <span class="badge bg-warning text-dark">قيد الانتظار</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
