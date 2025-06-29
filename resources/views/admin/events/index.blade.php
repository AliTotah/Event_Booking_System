@extends('layouts.app')

@section('content')
    <h2>إدارة الفعاليات</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">➕ إضافة فعالية</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الموقع</th>
                <th>التاريخ</th>
                <th>الوقت</th>
                <th>السعر</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->time }}</td>
                    <td>${{ $event->price }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">✏️ تعديل</a>
                        <a href="{{ route('admin.events.seats.index', $event->id) }}" class="btn btn-sm btn-info">🎟️ المقاعد</a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection