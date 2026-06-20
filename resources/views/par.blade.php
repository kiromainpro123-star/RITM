<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель</title>
    <style>
        body { font-family: sans-serif; background: #0d1117; color: #e6edf3; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .box { background: #161b22; border: 1px solid #30363d; border-radius: 12px; padding: 2rem; width: 340px; }
        h2 { margin-bottom: 1.5rem; font-size: 1.1rem; color: #58a6ff; }
        a { display: block; background: #21262d; border: 1px solid #30363d; border-radius: 8px; padding: .8rem 1rem; margin-bottom: .8rem; color: #c9d1d9; text-decoration: none; font-size: .9rem; transition: background .15s; }
        a:hover { background: #30363d; color: #58a6ff; }
        .label { font-size: .7rem; color: #8b949e; margin-bottom: .2rem; }
    </style>
</head>
<body>
<div class="box">
    <h2>Быстрый доступ</h2>

    <div class="label">Сайт</div>
    <a href="https://ritm-6isj.onrender.com" target="_blank">Открыть сайт</a>

    <div class="label">Админка</div>
    <a href="https://ritm-6isj.onrender.com/admin" target="_blank">Открыть админ панель</a>

    <div class="label">База данных (на сайте)</div>
    <a href="https://ritm-6isj.onrender.com/bd" target="_blank">Открыть /bd</a>

    <div class="label">База данных (Supabase)</div>
    <a href="https://supabase.com/dashboard/project/ibvkzqotqcxnudlaotrg/editor/17562?schema=public" target="_blank">Открыть Supabase Table Editor</a>

    <div class="label">Исходный код</div>
    <a href="https://github.com/kiromainpro123-star/RITM" target="_blank">Открыть GitHub репозиторий</a>
</div>
</body>
</html>
