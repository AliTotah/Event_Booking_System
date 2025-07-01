@extends('layouts.app')

@section('content')
    <h2>📅 قائمة الفعاليات</h2>

    <form method="GET" action="{{ route('home') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                   placeholder="🔍 ابحث عن فعالية...">
        </div>
        <div class="col-md-3">
            <input type="date" name="date" value="{{ request('date') }}" class="form-control" placeholder="📅 حسب التاريخ">
        </div>
        <div class="col-md-3">
            <input type="text" name="location" value="{{ request('location') }}" class="form-control"
                   placeholder="📍 حسب الموقع">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">تصفية</button>
        </div>
    </form>

    <div class="row">
        @forelse($events as $event)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                        <p>📍 {{ $event->location }}</p>
                        <p>📅 {{ $event->date }} | 🕒 {{ $event->time }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary">تفاصيل</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">لا توجد فعاليات مطابقة للبحث</div>
        @endforelse
    </div>
@endsection
