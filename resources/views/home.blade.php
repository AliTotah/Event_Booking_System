@extends('layouts.app')

@section('content')
    <h1 class="mb-4">الفعاليات المتاحة</h1>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <p>📍 {{ $event->location }}</p>
                        <p>📅 {{ $event->date }} - 🕒 {{ $event->time }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">تفاصيل</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection