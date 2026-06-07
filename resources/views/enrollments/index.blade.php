@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Мои записи на кружки</span>
                    <a href="{{ route('enroll.create') }}" class="btn btn-primary">Записать ребёнка</a>
                </div>
                <div class="card-body">
                    @if($enrollments->isEmpty())
                        <p>Пока нет записей. Запишите ребёнка на занятие.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ребёнок</th>
                                        <th>Возраст</th>
                                        <th>Кружок</th>
                                        <th>Телефон</th>
                                        <th>Статус</th>
                                        <th>Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments as $item)
                                        <tr>
                                            <td>{{ $item->child_name }}</td>
                                            <td>{{ $item->child_age }}</td>
                                            <td>{{ $item->club }}</td>
                                            <td>{{ $item->parent_phone }}</td>
                                            <td>
                                                @if($item->processed)
                                                    <span class="badge bg-success">Обработано</span>
                                                @else
                                                    <span class="badge bg-secondary">На рассмотрении</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
