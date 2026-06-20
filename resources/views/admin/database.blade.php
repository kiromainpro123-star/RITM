@extends('layouts.admin')
@section('page-title', 'База данных')

@section('content')

<style>
.db-section { margin-bottom: 2rem; }
.db-section h3 { font-size: 1rem; font-weight: 800; margin-bottom: .8rem; color: #1a1a2e; display:flex; align-items:center; gap:.5rem; }
.db-table-wrap { background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.06); overflow:hidden; }
.db-table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.db-table { width:100%; border-collapse:collapse; font-size:.8rem; min-width:400px; }
.db-table th { background:#1a1a2e; color:#fff; padding:.6rem .8rem; text-align:left; white-space:nowrap; font-size:.75rem; }
.db-table td { padding:.6rem .8rem; border-bottom:1px solid #f0f0f0; color:#333; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.db-table tr:last-child td { border-bottom:none; }
.db-table tr:hover td { background:#f8f9fa; }
.count-badge { background:#e94560; color:#fff; border-radius:20px; padding:.15rem .6rem; font-size:.75rem; font-weight:700; }
.empty-row td { text-align:center; color:#999; padding:1.5rem; }
</style>

@php
    $tables = [
        ['name' => 'users', 'icon' => '👥', 'data' => $users],
        ['name' => 'news', 'icon' => '📰', 'data' => $news],
        ['name' => 'news_media', 'icon' => '🖼️', 'data' => $news_media],
        ['name' => 'enrollments', 'icon' => '📝', 'data' => $enrollments],
    ];
@endphp

@foreach($tables as $table)
<div class="db-section">
    <h3>
        {{ $table['icon'] }} {{ $table['name'] }}
        <span class="count-badge">{{ count($table['data']) }} строк</span>
    </h3>
    <div class="db-table-wrap">
        <div class="db-table-container">
            @if(count($table['data']) > 0)
            <table class="db-table">
                <thead>
                    <tr>
                        @foreach(array_keys((array)$table['data'][0]) as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($table['data'] as $row)
                    <tr>
                        @foreach((array)$row as $key => $val)
                            <td title="{{ $val }}">
                                @if($key === 'password')
                                    <span style="color:#999">••••••••••••</span>
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
            <table class="db-table">
                <tbody>
                    <tr class="empty-row"><td colspan="10">Таблица пустая</td></tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endforeach

@endsection
