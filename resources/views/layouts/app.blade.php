<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'System Attendance')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <header>
        <nav>
            <strong> System Attendance : </strong>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('students.index') }}">Students</a>
        </nav>
    </header>
    @yield('content')
</body>

</html>
