@extends('layouts.admin')
@section('page-title', 'Загрузить фото')

@section('content')
<div class="form-card">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Подпись (необязательно)</label>
            <input type="text" name="title" value="{{ old('title') }}" placeholder="Например: Концерт 2025">
        </div>

        <div class="form-group">
            <label>Фотографии (можно выбрать несколько)</label>
            <input type="file" name="images[]" accept="image/*" multiple required>
        </div>

        <div style="display:flex;gap:1rem;">
            <button type="submit" class="btn btn-primary">Загрузить</button>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>
@endsection
