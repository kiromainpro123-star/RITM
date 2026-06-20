<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ — Клуб «Ритм»</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Nunito', sans-serif; background: #f0f2f5; color: #2d2d2d; display: flex; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* SIDEBAR */
        .sidebar { width: 240px; background: #1a1a2e; color: #fff; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-logo { padding: 1.5rem; font-size: 1.2rem; font-weight: 800; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-logo span { color: #e94560; }
        .sidebar nav { flex: 1; padding: 1rem 0; }
        .sidebar nav a { display: flex; align-items: center; gap: .7rem; padding: .75rem 1.5rem; color: #aaa; font-weight: 600; font-size: .9rem; transition: all .2s; }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(233,69,96,.15); color: #e94560; }
        .sidebar nav a .ico { font-size: 1.1rem; }
        .sidebar-footer { padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,.1); }
        .sidebar-footer a { color: #aaa; font-size: .85rem; }
        .sidebar-footer a:hover { color: #e94560; }

        /* MAIN */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { background: #fff; padding: .9rem 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; box-shadow: 0 1px 4px rgba(0,0,0,.08); flex-wrap: wrap; }
        .topbar h1 { font-size: 1.2rem; font-weight: 700; margin-right: auto; }
        .topbar .topbar-links { display: flex; gap: .75rem; align-items: center; flex-wrap: wrap; }
        .topbar .topbar-links a { color: #4f4f5c; text-decoration: none; font-weight: 600; padding: .5rem .9rem; border-radius: 10px; background: #f5f7fb; transition: background .2s, color .2s; }
        .topbar .topbar-links a:hover { background: #e9ebf5; color: #1f2a55; }
        .topbar .user { font-size: .9rem; color: #777; }
        .content { flex: 1; padding: 2rem; overflow-y: auto; }

        /* ALERTS */
        .alert { padding: .9rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 600; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }

        /* CARDS */
        .stat-cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .stat-card .num { font-size: 2.5rem; font-weight: 800; color: #e94560; }
        .stat-card .label { color: #777; font-size: .9rem; margin-top: .3rem; }

        /* TABLE */
        .table-wrap { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.06); overflow: hidden; }
        .table-header { padding: 1.2rem 1.5rem; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #eee; flex-wrap: wrap; gap: 1rem; }
        .table-header h2 { font-size: 1.1rem; font-weight: 700; }
        .table-container { overflow-x: auto; position: relative; }
        .table-scroll-hint { display: none; padding: .5rem 1rem; background: #fff3cd; color: #856404; font-size: .8rem; text-align: center; border-bottom: 1px solid #ffeaa7; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th { background: #f8f9fa; padding: .8rem 1rem; text-align: left; font-size: .85rem; color: #777; font-weight: 700; white-space: nowrap; }
        td { padding: .8rem 1rem; border-bottom: 1px solid #f0f0f0; font-size: .9rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: .2rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 700; white-space: nowrap; }
        .badge-green { background: #d4edda; color: #155724; }
        .badge-gray { background: #e9ecef; color: #666; }

        /* FORM */
        .form-card { background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); max-width: 700px; }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; font-weight: 700; font-size: .9rem; margin-bottom: .4rem; }
        input[type=text], input[type=file], textarea, select { width: 100%; padding: .7rem 1rem; border: 1.5px solid #ddd; border-radius: 8px; font-family: inherit; font-size: .95rem; transition: border .2s; }
        input:focus, textarea:focus { outline: none; border-color: #e94560; }
        textarea { min-height: 150px; resize: vertical; }
        .checkbox-label { display: flex; align-items: center; gap: .5rem; cursor: pointer; font-weight: 600; }
        input[type=checkbox] { width: auto; }

        /* BUTTONS */
        .btn { display: inline-block; padding: .6rem 1.4rem; border-radius: 8px; font-weight: 700; font-size: .9rem; cursor: pointer; border: none; transition: all .2s; }
        .btn-primary { background: #e94560; color: #fff; }
        .btn-primary:hover { background: #c73652; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-secondary:hover { background: #545b62; }
        .btn-danger { background: #dc3545; color: #fff; font-size: .8rem; padding: .4rem .9rem; }
        .btn-danger:hover { background: #b02a37; }
        .btn-edit { background: #0d6efd; color: #fff; font-size: .8rem; padding: .4rem .9rem; }
        .btn-edit:hover { background: #0a58ca; }

        /* GALLERY ADMIN */
        .photo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; }
        .photo-item { position: relative; border-radius: 8px; overflow: hidden; }
        .photo-item img { width: 100%; height: 140px; object-fit: cover; display: block; }
        .photo-item .del-btn { position: absolute; top: 6px; right: 6px; }

        @media(max-width:768px){
            .sidebar { display:none; }
            .main { width:100%; }
            .topbar { padding:.8rem 1rem; }
            .topbar h1 { font-size: 1rem; }
            .content { padding:1rem; }
            .table-wrap { border-radius: 8px; }
            .table-header { padding: 1rem; }
            .table-header h2 { font-size: 1rem; }
            .table-scroll-hint { display: block; }
            .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
            table { font-size:.75rem; min-width: 500px; }
            td, th { padding:.6rem .5rem; }
            td:first-child, th:first-child { padding-left: .8rem; }
            td:last-child, th:last-child { padding-right: .8rem; }
            .btn { font-size: .75rem; padding: .4rem .8rem; }
            .btn-edit, .btn-danger { font-size: .7rem; padding: .35rem .7rem; }
            .stat-cards { grid-template-columns:1fr 1fr; gap: 1rem; }
            .stat-card { padding: 1rem; }
            .stat-card .num { font-size: 2rem; }
        }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">Клуб <span>«Ритм»</span></div>
    <nav>
        <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <span class="ico">🏠</span> Главная
        </a>
        <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news*') ? 'active' : '' }}">
            <span class="ico">📰</span> Новости
        </a>
        <a href="{{ route('admin.enrollments.index') }}" class="{{ request()->routeIs('admin.enrollments*') ? 'active' : '' }}">
            <span class="ico">📝</span> Записи
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ route('home') }}">← На сайт</a>
        &nbsp;&nbsp;
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выйти</a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <h1>@yield('page-title', 'Панель управления')</h1>
        <div class="topbar-links">
            <a href="{{ route('home') }}">На сайт</a>
            <span class="user">{{ auth()->user()->name }}</span>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
