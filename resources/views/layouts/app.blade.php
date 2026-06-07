<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ритм')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d1b4b 0%, #1a2a6c 50%, #2d3a8c 100%);
            min-height: 100vh;
            color: #f8fafc;
        }

        .navbar {
            background: rgba(13, 27, 75, 0.94);
            backdrop-filter: blur(12px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.16);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f8fafc;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            list-style: none;
            flex-wrap: wrap;
        }

        .nav-links li {
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #dbeafe;
            font-weight: 500;
            transition: color 0.25s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            color: #ffffff;
        }

        .nav-links .btn {
            padding: 0.45rem 0.85rem;
            font-size: 0.95rem;
            border-radius: 12px;
        }

        .btn {
            padding: 0.55rem 1.1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
            border: none;
            cursor: pointer;
            display: inline-block;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5b6fe2 0%, #8c5bdc 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(91, 111, 226, 0.28);
        }

        .btn-outline {
            border: 2px solid rgba(255,255,255,0.74);
            color: #f8fafc;
            background: rgba(255, 255, 255, 0.08);
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.96);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(17, 24, 39, 0.12);
            border: 1px solid rgba(102, 126, 234, 0.12);
        }

        .card-header {
            padding: 1.5rem 2rem;
            background: #f7f9ff;
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(102, 126, 234, 0.12);
        }

        .card-body {
            padding: 2rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #1f2a55;
        }

        .form-control,
        .form-select,
        textarea.form-control {
            width: 100%;
            min-height: 44px;
            padding: 0.95rem 1rem;
            border-radius: 14px;
            border: 1px solid rgba(100, 116, 139, 0.18);
            background: #fff;
            color: #1f2937;
            font-size: 0.95rem;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .form-control:focus,
        .form-select:focus,
        textarea.form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.14);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .mb-3 {
            margin-bottom: 1.25rem;
        }

        .invalid-feedback {
            color: #e11d48;
            margin-top: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        .alert {
            padding: 1rem 1.2rem;
            border-radius: 16px;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
            margin-bottom: 1.5rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
        }

        .col-md-8 {
            width: 100%;
            padding: 0 0.75rem;
        }

        @media (min-width: 768px) {
            .col-md-8 {
                width: 66.666667%;
            }
        }

        .row.justify-content-center {
            justify-content: center;
        }

        .row.justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.25rem;
            background: white;
        }

        .table th,
        .table td {
            padding: 0.9rem 1rem;
            border: 1px solid rgba(148, 163, 184, 0.18);
            vertical-align: top;
            text-align: left;
            color: #1f2937;
        }

        .table th {
            background: rgba(91, 111, 226, 0.08);
            color: #1f2937;
            font-weight: 700;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .badge.bg-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge.bg-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .card {
            margin: 0 auto 1.5rem;
        }

        .card-header.d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .auth-container {
            min-height: calc(100vh - 80px);
        }

        .user-name {
            font-weight: 600;
            color: #667eea;
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 0.75rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .navbar-container {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="logo">Ритм</a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><a href="{{ route('news') }}">Новости</a></li>
                @auth
                    <li><a href="{{ route('enroll.create') }}">Записаться</a></li>
                    <li><a href="{{ route('enroll.index') }}">Мои заявки</a></li>
                @endauth
                @guest
                    <li><a href="{{ route('login') }}" class="btn btn-outline">Войти</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary">Регистрация</a></li>
                @else
                    <li class="user-menu">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.index') }}" class="btn btn-outline">Админ</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Выйти</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
