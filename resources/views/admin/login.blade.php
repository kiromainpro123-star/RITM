<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход — Клуб «Ритм»</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Nunito', sans-serif; background: #0d1b4b; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: #fff; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 400px; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        .login-logo { text-align: center; margin-bottom: 2rem; }
        .login-logo h1 { font-size: 1.8rem; font-weight: 800; color: #0d1b4b; }
        .login-logo h1 span { color: #9b59b6; }
        .login-logo p { color: #777; font-size: .9rem; margin-top: .3rem; }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; font-weight: 700; font-size: .85rem; color: #444; margin-bottom: .4rem; }
        input { width: 100%; padding: .8rem 1rem; border: 1.5px solid #ddd; border-radius: 8px; font-family: inherit; font-size: .95rem; transition: border .2s; }
        input:focus { outline: none; border-color: #0d1b4b; }
        .btn { width: 100%; padding: .9rem; background: #0d1b4b; color: #fff; border: none; border-radius: 8px; font-family: inherit; font-size: 1rem; font-weight: 700; cursor: pointer; transition: background .2s; }
        .btn:hover { background: #1a2a6c; }
        .error { background: #fde8e8; color: #c0392b; padding: .8rem 1rem; border-radius: 8px; font-size: .9rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ asset('images/logo.png') }}" alt="Ритм" style="height:70px;margin-bottom:.5rem;">
        @else
            <h1>Клуб <span>«Ритм»</span></h1>
        @endif
        <p>Панель управления</p>
    </div>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="form-group">
            <label>Электронная почта</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@ritm.ru">
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" class="btn">Войти</button>
    </form>
</div>
</body>
</html>
