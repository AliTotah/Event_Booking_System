@extends('layouts.app')

@section('content')
    <h2>✏️ تعديل فعالية</h2>

    <form method="POST" action="{{ route('admin.events.update', $event->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>العنوان</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
        </div>
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description" class="form-control">{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>الموقع</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
        </div>
        <div class="mb-3">
            <label>التاريخ</label>
            <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
        </div>
        <div class="mb-3">
            <label>الوقت</label>
            <input type="time" name="time" class="form-control" value="{{ $event->time }}" required>
        </div>
        <div class="mb-3">
            <label>السعر ($)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $event->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary">💾 تحديث</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
@endsection