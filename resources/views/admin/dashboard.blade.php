@extends('layouts.app')

@section('content')
    <h2 class="mb-4">لوحة تحكم المشرف</h2>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>👥 عدد المستخدمين</h5>
                <h3>{{ $usersCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>🎫 عدد الفعاليات</h5>
                <h3>{{ $eventsCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>📦 عدد الحجوزات</h5>
                <h3>{{ $bookingsCount }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>💳 عدد الدفعات</h5>
                <h3>{{ $paymentsCount }}</h3>
            </div>
        </div>
    </div>

    <hr>

    <h4>آخر الحجوزات</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>المستخدم</th>
                <th>الفعالية</th>
                <th>عدد التذاكر</th>
                <th>المبلغ</th>
                <th>الحالة</th>
                <th>تاريخ الحجز</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestBookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->event->title }}</td>
                    <td>{{ $booking->num_tickets }}</td>
                    <td>${{ $booking->total_price }}</td>
                    <td>{{ $booking->status }}</td>
                    <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection