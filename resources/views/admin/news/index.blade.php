@extends('layouts.admin')
@section('page-title', 'Новости')

@section('content')
<div class="table-wrap">
    <div class="table-header">
        <h2>Все новости</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Добавить</a>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Заголовок</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if($item->published)
                            <span class="badge badge-green">Опубликовано</span>
                        @else
                            <span class="badge badge-gray">Скрыто</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                    <td style="display:flex;gap:.5rem;">
                        <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-edit">Изменить</a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Удалить?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;color:#999;padding:2rem;">Новостей нет</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top:1rem;">{{ $news->links() }}</div>
@endsection
