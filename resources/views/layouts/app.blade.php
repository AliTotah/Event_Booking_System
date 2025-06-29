<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>نظام حجز الفعاليات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl">
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">الفعاليات</a>
        <div>
            @auth
                مرحباً، {{ auth()->user()->name }}
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-link" type="submit">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary">دخول</a>
                <a href="{{ route('register') }}" class="btn btn-primary">تسجيل</a>
            @endauth
             @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning me-2">لوحة التحكم</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>