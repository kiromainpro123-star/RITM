<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клуб «Ритм» — Омск</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Nunito', sans-serif; color: #2d2d2d; background: #fff; }
        a { text-decoration: none; color: inherit; }

        /* NAV */
        nav { background: #0d1b4b; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 10px rgba(0,0,0,.3); }
        .nav-logo { display: flex; align-items: center; gap: .7rem; padding: .6rem 0; }
        .nav-logo img { height: 48px; width: auto; }
        .nav-logo span { color: #fff; font-size: 1.1rem; font-weight: 800; letter-spacing: 1px; }
        .nav-links { display: flex; gap: 0.6rem; align-items: center; }
        .nav-links a { color: #ccc; padding: .65rem .95rem; font-weight: 600; font-size: .92rem; transition: color .2s; white-space: nowrap; }
        .nav-links a:hover, .nav-links a.active { color: #fff; }
        .nav-links .auth-button { border-radius: 999px; padding: .45rem .85rem; border: 1px solid rgba(255,255,255,.25); font-size: .88rem; text-align: center; }
        .nav-links .auth-button.register { background: #9b59b6; color: #fff; border-color: #9b59b6; }
        .nav-links .auth-button.login { background: rgba(255,255,255,.12); color: #fff; }
        .burger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:.5rem; }
        .burger span { display:block; width:24px; height:2px; background:#fff; border-radius:2px; transition:.3s; }
        @media(max-width:768px){
            .nav-links { display:none; flex-direction:column; position:absolute; top:100%; left:0; right:0; background:#0d1b4b; padding:.5rem 0; box-shadow:0 4px 12px rgba(0,0,0,.3); }
            .nav-links.open { display:flex; }
            .nav-links a { padding:.9rem 2rem; border-bottom:1px solid rgba(255,255,255,.05); }
            .burger { display:flex; }
        }

        /* HERO */
        .hero { background: linear-gradient(135deg, #0d1b4b 0%, #1a2a6c 50%, #2d3a8c 100%); color: #fff; padding: 6rem 2rem; text-align: center; }
        .hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 1rem; }
        .hero h1 span { color: #9b59b6; }
        .hero p { font-size: 1.2rem; color: #aaa; max-width: 600px; margin: 0 auto 2rem; }
        .btn { display: inline-block; background: #1a3a8c; color: #fff; padding: .75rem 1.6rem; border-radius: 18px; font-weight: 700; transition: background .2s, transform .1s; }
        .btn:hover { background: #0d2a6c; transform: translateY(-1px); }
        .btn-outline { background: transparent; border: 2px solid #9b59b6; color: #9b59b6; }
        .btn-outline:hover { background: #9b59b6; color: #fff; }
        .btn-secondary { background: #fff; color: #1a3a8c; border: 2px solid rgba(255,255,255,.35); }
        .btn-secondary:hover { background: #e9eaf4; color: #0d2a6c; }

        /* SECTIONS */
        section { padding: 4rem 2rem; }
        .container { max-width: 1100px; margin: 0 auto; }
        .section-title { text-align: center; font-size: 2rem; font-weight: 800; margin-bottom: .5rem; }
        .section-title span { color: #e94560; }
        .section-sub { text-align: center; color: #777; margin-bottom: 3rem; }

        .cabinet-info { background: #f4f5ff; padding: 3rem 0; }
        .cabinet-box { max-width: 820px; margin: 0 auto; background: #fff; border-radius: 24px; padding: 2rem; box-shadow: 0 20px 60px rgba(0,0,0,.08); }
        .cabinet-box h2 { font-size: 2rem; font-weight: 800; margin-bottom: 1rem; color: #0d1b4b; }
        .cabinet-box p { color: #555; font-size: 1rem; margin-bottom: 1rem; }
        .cabinet-box ul { list-style: disc; padding-left: 1.2rem; color: #555; }
        .cabinet-box ul li { margin-bottom: .6rem; }

        /* CARDS */
        .cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .card { background: #f8f9fa; border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 1.2rem; }
        .card-body h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: .5rem; }
        .card-body p { color: #666; font-size: .9rem; line-height: 1.6; }
        .card-date { font-size: .8rem; color: #999; margin-bottom: .4rem; }
        .card-link { display: inline-block; margin-top: .8rem; color: #1a3a8c; font-weight: 700; font-size: .9rem; }

        /* DIRECTIONS */
        .directions { background: #f8f9fa; }
        .dir-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; }
        .dir-card { background: #fff; border-radius: 12px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .dir-icon { font-size: 2.5rem; margin-bottom: .8rem; }
        .dir-card h3 { font-weight: 700; margin-bottom: .5rem; }
        .dir-card p { color: #666; font-size: .85rem; line-height: 1.6; }

        /* GALLERY GRID */
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem; }
        .gallery-grid img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; transition: transform .2s; cursor: pointer; }
        .gallery-grid img:hover { transform: scale(1.02); }

        /* SCHEDULE */
        .schedule-table { width: 100%; border-collapse: collapse; max-width: 500px; margin: 0 auto; }
        .schedule-table td { padding: .6rem 1rem; border-bottom: 1px solid #eee; }
        .schedule-table td:first-child { font-weight: 700; color: #1a1a2e; }
        .schedule-table td:last-child { color: #555; }
        .closed { color: #e94560 !important; }

        /* CONTACTS */
        .contacts-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; }
        .contact-card { background: #f8f9fa; border-radius: 12px; padding: 1.5rem; }
        .contact-card .icon { font-size: 1.8rem; margin-bottom: .5rem; }
        .contact-card h4 { font-weight: 700; margin-bottom: .3rem; }
        .contact-card p, .contact-card a { color: #555; font-size: .95rem; }

        /* FOOTER */
        footer { background: #0d1b4b; color: #aaa; text-align: center; padding: 2rem; font-size: .9rem; }
        footer a { color: #9b59b6; }

        /* ABOUT SECTION */
        .about-content { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; }
        .about-text h2 { font-size: 2rem; font-weight: 800; margin-bottom: 1rem; }
        .about-text p { color: #555; line-height: 1.8; margin-bottom: 1rem; }
        .about-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .stat { background: #0d1b4b; color: #fff; border-radius: 12px; padding: 1.5rem; text-align: center; }
        .stat .num { font-size: 2rem; font-weight: 800; color: #9b59b6; }
        .stat .label { font-size: .85rem; color: #aaa; margin-top: .3rem; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .about-content { grid-template-columns: 1fr; }
            .nav-links a { padding: .9rem .6rem; font-size: .8rem; }
            .cards { grid-template-columns: 1fr; }
            .dir-grid { grid-template-columns: 1fr 1fr; }
            .contacts-grid { grid-template-columns: 1fr; }
            .about-stats { grid-template-columns: 1fr 1fr; }
            section { padding: 2.5rem 1rem; }
            .hero { padding: 3.5rem 1rem; }
            .schedule-table { font-size: .85rem; }
        }
        @media (max-width: 480px) {
            .dir-grid { grid-template-columns: 1fr; }
            .about-stats { grid-template-columns: 1fr 1fr; }
            .hero h1 { font-size: 1.7rem; }
            .btn { padding: .7rem 1.4rem; font-size: .9rem; }
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('home') }}" class="nav-logo">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Ритм">
        @else
            <span>Клуб «Ритм»</span>
        @endif
    </a>
    <div class="nav-links" id="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
        <a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">Новости</a>
        <a href="{{ route('home') }}#about">О клубе</a>
        <a href="{{ route('home') }}#contacts">Контакты</a>
        @auth
            <a href="{{ route('enroll.index') }}" class="{{ request()->routeIs('enroll.*') ? 'active' : '' }}">Мои записи</a>
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">Админ</a>
            @endif
        @endauth
        @guest
            <a href="{{ route('login') }}" class="auth-button login">Войти</a>
            <a href="{{ route('register') }}" class="auth-button register">Регистрация</a>
        @else
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        @endguest
    </div>
    <div class="burger" onclick="document.getElementById('nav-links').classList.toggle('open')">
        <span></span><span></span><span></span>
    </div>
</nav>

@yield('content')

<footer>
    <p>© {{ date('Y') }} Клуб «Ритм» — Омск, ул. Юбилейная, 6 &nbsp;|&nbsp; <a href="tel:+73812665580">+7 (3812) 66-55-80</a></p>
</footer>
</body>
</html>
