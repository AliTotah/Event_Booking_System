@extends('layouts.app')

@section('content')
    <h2>⚙️ إدارة الفعاليات</h2>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'تم بنجاح',
                text: '{{ session("success") }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
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

                        <form class="d-inline delete-form" data-name="{{ $event->title }}"
                              action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            let name = this.dataset.name || 'هذه الفعالية';

            Swal.fire({
                title: `هل أنت متأكد من حذف "${name}"؟`,
                text: "لا يمكن التراجع بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذفه!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection
