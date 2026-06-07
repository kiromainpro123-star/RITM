@extends('layouts.admin')
@section('page-title', 'Панель управления')

@section('content')
<div class="stat-cards">
    <div class="stat-card">
        <div class="num">{{ $newsCount }}</div>
        <div class="label">Новостей</div>
    </div>
    <div class="stat-card">
        <div class="num">{{ $enrollmentsCount }}</div>
        <div class="label">Заявок на кружки</div>
    </div>
</div>

<div style="display:flex;gap:1rem;flex-wrap:wrap;">
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Добавить новость</a>
    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-secondary">Посмотреть заявки</a>
</div>
@endsection
