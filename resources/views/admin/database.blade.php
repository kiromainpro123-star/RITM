<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>База данных — Клуб «Ритм»</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Nunito', sans-serif; background: #0d1117; color: #e6edf3; display: flex; height: 100vh; overflow: hidden; }

        /* SIDEBAR */
        .sidebar { width: 220px; background: #161b22; border-right: 1px solid #30363d; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 1rem; border-bottom: 1px solid #30363d; }
        .sidebar-header h2 { font-size: .9rem; font-weight: 800; color: #58a6ff; }
        .sidebar-header p { font-size: .75rem; color: #8b949e; margin-top: .2rem; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: .5rem 0; }
        .sidebar-section { padding: .5rem 1rem .3rem; font-size: .7rem; color: #8b949e; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        .table-btn { display: flex; align-items: center; gap: .5rem; padding: .5rem 1rem; cursor: pointer; font-size: .85rem; color: #c9d1d9; transition: background .15s; border: none; background: none; width: 100%; text-align: left; }
        .table-btn:hover { background: #21262d; }
        .table-btn.active { background: #1f6feb22; color: #58a6ff; border-left: 2px solid #58a6ff; }
        .table-btn .icon { font-size: 1rem; }
        .table-btn .count { margin-left: auto; background: #21262d; color: #8b949e; border-radius: 20px; padding: .1rem .5rem; font-size: .7rem; }
        .table-btn.active .count { background: #1f6feb44; color: #58a6ff; }
        .sidebar-footer { padding: 1rem; border-top: 1px solid #30363d; }
        .sidebar-footer a { color: #8b949e; font-size: .8rem; text-decoration: none; }
        .sidebar-footer a:hover { color: #58a6ff; }

        /* MAIN */
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { background: #161b22; border-bottom: 1px solid #30363d; padding: .8rem 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
        .topbar-left { display: flex; align-items: center; gap: .8rem; }
        .topbar-left h1 { font-size: 1rem; font-weight: 800; color: #e6edf3; }
        .topbar-left .breadcrumb { color: #8b949e; font-size: .85rem; }
        .topbar-right { display: flex; gap: .5rem; align-items: center; }
        .btn-refresh { background: #21262d; border: 1px solid #30363d; color: #c9d1d9; padding: .4rem .9rem; border-radius: 6px; font-size: .8rem; cursor: pointer; font-family: inherit; transition: background .15s; }
        .btn-refresh:hover { background: #30363d; }
        .btn-back { background: #1f6feb; color: #fff; padding: .4rem .9rem; border-radius: 6px; font-size: .8rem; cursor: pointer; font-family: inherit; border: none; text-decoration: none; display: inline-block; }

        /* CONTENT */
        .content { flex: 1; overflow-y: auto; padding: 1.5rem; }

        /* STATS BAR */
        .stats-bar { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 1rem; }
        .stat-card .num { font-size: 1.8rem; font-weight: 800; color: #58a6ff; }
        .stat-card .label { font-size: .75rem; color: #8b949e; margin-top: .2rem; }

        /* TABLE */
        .table-wrap { background: #161b22; border: 1px solid #30363d; border-radius: 8px; overflow: hidden; }
        .table-header { padding: .8rem 1rem; border-bottom: 1px solid #30363d; display: flex; align-items: center; gap: .8rem; flex-wrap: wrap; }
        .table-header h3 { font-size: .95rem; font-weight: 700; color: #e6edf3; }
        .table-header .meta { font-size: .75rem; color: #8b949e; }
        .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        table { width: 100%; border-collapse: collapse; min-width: 400px; }
        th { background: #0d1117; padding: .6rem 1rem; text-align: left; font-size: .75rem; color: #8b949e; font-weight: 700; white-space: nowrap; border-bottom: 1px solid #30363d; }
        td { padding: .6rem 1rem; border-bottom: 1px solid #21262d; font-size: .8rem; color: #c9d1d9; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #21262d44; }
        .null-val { color: #8b949e; font-style: italic; }
        .bool-true { color: #3fb950; font-weight: 700; }
        .bool-false { color: #f85149; font-weight: 700; }
        .id-val { color: #58a6ff; font-weight: 700; }
        .pass-val { color: #8b949e; letter-spacing: .1em; }
        .empty-state { text-align: center; padding: 3rem; color: #8b949e; font-size: .9rem; }

        /* SCHEMA */
        .schema-wrap { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; }
        .schema-wrap h4 { font-size: .85rem; font-weight: 700; color: #8b949e; margin-bottom: .8rem; }
        .schema-cols { display: flex; flex-wrap: wrap; gap: .4rem; }
        .schema-col { background: #0d1117; border: 1px solid #30363d; border-radius: 4px; padding: .25rem .6rem; font-size: .75rem; color: #c9d1d9; }
        .schema-col.pk { border-color: #58a6ff44; color: #58a6ff; }
        .schema-col.fk { border-color: #3fb95044; color: #3fb950; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>🗄️ База данных</h2>
        <p>PostgreSQL · ritm_db</p>
    </div>
    <div class="sidebar-nav">
        <div class="sidebar-section">Таблицы</div>
        <button class="table-btn active" onclick="showTable('users')" id="btn-users">
            <span class="icon">👥</span> users
            <span class="count" id="cnt-users">{{ count($users) }}</span>
        </button>
        <button class="table-btn" onclick="showTable('news')" id="btn-news">
            <span class="icon">📰</span> news
            <span class="count" id="cnt-news">{{ count($news) }}</span>
        </button>
        <button class="table-btn" onclick="showTable('news_media')" id="btn-news_media">
            <span class="icon">🖼️</span> news_media
            <span class="count" id="cnt-news_media">{{ count($news_media) }}</span>
        </button>
        <button class="table-btn" onclick="showTable('enrollments')" id="btn-enrollments">
            <span class="icon">📝</span> enrollments
            <span class="count" id="cnt-enrollments">{{ count($enrollments) }}</span>
        </button>
        <div class="sidebar-section" style="margin-top:.5rem;">Система</div>
        <button class="table-btn" onclick="showTable('migrations')" id="btn-migrations">
            <span class="icon">⚙️</span> migrations
            <span class="count" id="cnt-migrations">{{ count($migrations) }}</span>
        </button>
    </div>
    <div class="sidebar-footer">
        <a href="{{ route('admin.index') }}">← Админ панель</a>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="topbar-left">
            <h1 id="current-table-name">👥 users</h1>
            <span class="breadcrumb">ritm_db → <span id="breadcrumb-table">users</span></span>
        </div>
        <div class="topbar-right">
            <button class="btn-refresh" onclick="location.reload()">🔄 Обновить</button>
            <a href="{{ route('admin.index') }}" class="btn-back">← Назад</a>
        </div>
    </div>

    <div class="content">

        {{-- STATS --}}
        <div class="stats-bar">
            <div class="stat-card">
                <div class="num">{{ count($users) }}</div>
                <div class="label">Пользователей</div>
            </div>
            <div class="stat-card">
                <div class="num">{{ count($news) }}</div>
                <div class="label">Новостей</div>
            </div>
            <div class="stat-card">
                <div class="num">{{ count($news_media) }}</div>
                <div class="label">Медиафайлов</div>
            </div>
            <div class="stat-card">
                <div class="num">{{ count($enrollments) }}</div>
                <div class="label">Заявок</div>
            </div>
        </div>

        @php
        $allTables = [
            'users' => [
                'icon' => '👥',
                'data' => $users,
                'schema' => ['id (PK)', 'name', 'email', 'password', 'is_admin', 'created_at', 'updated_at'],
                'pk' => ['id'],
            ],
            'news' => [
                'icon' => '📰',
                'data' => $news,
                'schema' => ['id (PK)', 'title', 'content', 'image', 'published', 'created_at', 'updated_at'],
                'pk' => ['id'],
            ],
            'news_media' => [
                'icon' => '🖼️',
                'data' => $news_media,
                'schema' => ['id (PK)', 'news_id (FK→news)', 'file', 'type', 'created_at', 'updated_at'],
                'pk' => ['id'],
            ],
            'enrollments' => [
                'icon' => '📝',
                'data' => $enrollments,
                'schema' => ['id (PK)', 'user_id (FK→users)', 'child_name', 'child_age', 'club', 'parent_phone', 'notes', 'processed', 'created_at', 'updated_at'],
                'pk' => ['id'],
            ],
            'migrations' => [
                'icon' => '⚙️',
                'data' => $migrations,
                'schema' => ['id (PK)', 'migration', 'batch'],
                'pk' => ['id'],
            ],
        ];
        @endphp

        @foreach($allTables as $tableName => $tableData)
        <div id="table-{{ $tableName }}" class="table-section" style="{{ $tableName !== 'users' ? 'display:none' : '' }}">

            {{-- SCHEMA --}}
            <div class="schema-wrap">
                <h4>Структура таблицы · {{ $tableName }}</h4>
                <div class="schema-cols">
                    @foreach($tableData['schema'] as $col)
                        <span class="schema-col {{ str_contains($col, 'PK') ? 'pk' : (str_contains($col, 'FK') ? 'fk' : '') }}">
                            {{ $col }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- DATA --}}
            <div class="table-wrap">
                <div class="table-header">
                    <h3>{{ $tableData['icon'] }} {{ $tableName }}</h3>
                    <span class="meta">{{ count($tableData['data']) }} строк</span>
                </div>
                <div class="table-container">
                    @if(count($tableData['data']) > 0)
                    <table>
                        <thead>
                            <tr>
                                @foreach(array_keys((array)$tableData['data'][0]) as $col)
                                    <th>{{ $col }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tableData['data'] as $row)
                            <tr>
                                @foreach((array)$row as $key => $val)
                                <td title="{{ $val }}">
                                    @if($val === null)
                                        <span class="null-val">NULL</span>
                                    @elseif($key === 'password')
                                        <span class="pass-val">••••••••••••</span>
                                    @elseif($key === 'id')
                                        <span class="id-val">{{ $val }}</span>
                                    @elseif($val === true || $val === 1 || $val === '1')
                                        <span class="bool-true">✓ true</span>
                                    @elseif($val === false || $val === 0 || $val === '0')
                                        <span class="bool-false">✗ false</span>
                                    @else
                                        {{ $val }}
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        Таблица пустая — данных нет
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<script>
const tableNames = {
    'users':       '👥 users',
    'news':        '📰 news',
    'news_media':  '🖼️ news_media',
    'enrollments': '📝 enrollments',
    'migrations':  '⚙️ migrations',
};

function showTable(name) {
    document.querySelectorAll('.table-section').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.table-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('table-' + name).style.display = 'block';
    document.getElementById('btn-' + name).classList.add('active');
    document.getElementById('current-table-name').textContent = tableNames[name];
    document.getElementById('breadcrumb-table').textContent = name;
}
</script>

</body>
</html>
