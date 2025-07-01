@extends('layouts.app')

@section('content')
    <h2>🎟️ إدارة المقاعد - {{ $event->title }}</h2>

    {{-- إشعار نجاح --}}
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

    {{-- نموذج إضافة مقعد --}}
    <form method="POST" action="{{ route('admin.events.seats.store', $event->id) }}" class="row g-3 mb-4">
        @csrf
        <div class="col-md-4">
            <input type="text" name="seat_number" class="form-control" placeholder="رقم المقعد" required>
        </div>
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="available">متاح</option>
                <option value="reserved">محجوز</option>
                <option value="sold">مباع</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-success">➕ إضافة</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">⬅️ رجوع</a>
        </div>
    </form>

    {{-- جدول المقاعد --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>رقم المقعد</th>
                <th>الحالة</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            @forelse($seats as $seat)
                <tr>
                    <td>{{ $seat->seat_number }}</td>
                    <td>
                        @if($seat->status == 'available')
                            <span class="badge bg-success">متاح</span>
                        @elseif($seat->status == 'reserved')
                            <span class="badge bg-warning text-dark">محجوز</span>
                        @else
                            <span class="badge bg-danger">مباع</span>
                        @endif
                    </td>
                    <td>
                        {{-- نموذج حذف مع SweetAlert --}}
                        <form method="POST" class="d-inline delete-form" data-name="المقعد {{ $seat->seat_number }}"
                              action="{{ route('admin.seats.destroy', $seat->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">لا توجد مقاعد مضافة لهذه الفعالية بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let name = this.dataset.name || 'هذا المقعد';

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
