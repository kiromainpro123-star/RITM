@extends('layouts.admin')
@section('page-title', 'Записи на кружки')

@section('content')
<div class="table-wrap">
    <div class="table-header">
        <h2>Все записи</h2>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ребёнок</th>
                    <th>Кружок</th>
                    <th>Родитель</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th>Действия</th>
                    <th>Дата</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->child_name }}</td>
                    <td>{{ $enrollment->club }}</td>
                    <td>{{ $enrollment->user->name }}</td>
                    <td>{{ $enrollment->parent_phone }}</td>
                    <td>
                        @if($enrollment->processed)
                            <span class="badge badge-green">Обработано</span>
                        @else
                            <span class="badge badge-gray">На рассмотрении</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.enrollments.toggle', $enrollment) }}" method="POST" style="display:inline-flex; gap:.5rem;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-secondary" style="min-width:160px;">
                                {{ $enrollment->processed ? 'Вернуть в рассмотрение' : 'Отметить обработано' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $enrollment->created_at->format('d.m.Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#999;padding:2rem;">Записей нет</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="margin-top:1rem;">{{ $enrollments->links() }}</div>
@endsection
