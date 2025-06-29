@extends('layouts.app')

@section('content')
    <h2>تسجيل الدخول</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label>البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">دخول</button>
    </form>
@endsection