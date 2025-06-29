@extends('layouts.app')

@section('content')
    <h2>{{ $event->title }}</h2>
    <p>{{ $event->description }}</p>
    <p><strong>الموقع:</strong> {{ $event->location }}</p>
    <p><strong>التاريخ:</strong> {{ $event->date }} | <strong>الوقت:</strong> {{ $event->time }}</p>
    <p><strong>السعر:</strong> {{ $event->price }}$</p>

    <hr>
    <h4>احجز تذكرتك</h4>
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="mb-3">
            <label>عدد التذاكر:</label>
            <input type="number" name="num_tickets" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">احجز الآن</button>
    </form>
@endsection