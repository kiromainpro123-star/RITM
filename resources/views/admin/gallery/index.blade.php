@extends('layouts.admin')
@section('page-title', 'Галерея')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
    <h2 style="font-size:1.1rem;font-weight:700;">Все фотографии</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Загрузить фото</a>
</div>

@if($photos->count())
<div class="photo-grid">
    @foreach($photos as $photo)
    <div class="photo-item">
        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}">
        <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" class="del-btn" onsubmit="return confirm('Удалить фото?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger" style="padding:.3rem .6rem;font-size:.75rem;">✕</button>
        </form>
    </div>
    @endforeach
</div>
<div style="margin-top:1rem;">{{ $photos->links() }}</div>
@else
<p style="color:#999;">Фотографий нет</p>
@endif
@endsection
