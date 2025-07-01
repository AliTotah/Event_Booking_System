@extends('layouts.app')

@section('content')
    <h2>➕ إضافة فعالية جديدة</h2>

    <form method="POST" action="{{ route('admin.events.store') }}">
        @csrf
        <div class="mb-3">
            <label>العنوان</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>الوصف</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>الموقع</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>التاريخ</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>الوقت</label>
            <input type="time" name="time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>السعر ($)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">💾 حفظ</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
@endsection
