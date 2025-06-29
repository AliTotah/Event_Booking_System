@extends('layouts.app')

@section('content')
    <h2>حجوزاتي</h2>

    @if($bookings->isEmpty())
        <p>لا توجد حجوزات حالياً.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الفعالية</th>
                    <th>عدد التذاكر</th>
                    <th>السعر الكلي</th>
                    <th>الحالة</th>
                    <th>تاريخ الحجز</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event->title }}</td>
                        <td>{{ $booking->num_tickets }}</td>
                        <td>${{ $booking->total_price }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection