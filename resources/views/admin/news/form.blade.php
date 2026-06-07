@extends('layouts.admin')
@section('page-title', $item ? 'Редактировать новость' : 'Новая новость')

@section('content')
<div class="form-card">
    <form action="{{ $item ? route('admin.news.update', $item) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($item) @method('PUT') @endif

        <div class="form-group">
            <label>Заголовок</label>
            <input type="text" name="title" value="{{ old('title', $item?->title) }}" required>
        </div>

        <div class="form-group">
            <label>Текст новости</label>
            <textarea name="content" required>{{ old('content', $item?->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Главное фото (обложка)</label>
            @if($item?->image)
                <img src="{{ asset('storage/' . $item->image) }}" style="height:100px;border-radius:6px;margin-bottom:.5rem;display:block;">
            @endif
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label>Фото и видео (можно выбрать несколько)</label>
            <div id="media-inputs">
                <input type="file" name="media[]" accept="image/*,video/*" multiple style="margin-bottom:.5rem;display:block;">
            </div>
            <button type="button" onclick="addMediaInput()" style="margin-top:.4rem;background:#f0f2f5;border:1.5px dashed #aaa;border-radius:8px;padding:.5rem 1rem;cursor:pointer;font-family:inherit;font-size:.9rem;color:#555;">+ Добавить ещё файлы</button>
            <small style="display:block;margin-top:.4rem;color:#999;">Зажми Ctrl для выбора нескольких файлов сразу. Форматы: jpg, png, gif, mp4, mov.</small>
        </div>

        {{-- Существующие медиа --}}
        @if($item && $item->media->count())
        <div class="form-group">
            <label>Прикреплённые файлы</label>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:.8rem;margin-top:.5rem;">
                @foreach($item->media as $m)
                <div style="position:relative;border-radius:8px;overflow:hidden;background:#f0f0f0;">
                    @if($m->type === 'image')
                        <img src="{{ asset('storage/' . $m->file) }}" style="width:100%;height:110px;object-fit:cover;display:block;">
                    @else
                        <video src="{{ asset('storage/' . $m->file) }}" style="width:100%;height:110px;object-fit:cover;display:block;" muted></video>
                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:2rem;">▶️</div>
                    @endif
                    <form action="{{ route('admin.news.media.destroy', $m) }}" method="POST" style="position:absolute;top:4px;right:4px;" onsubmit="return confirm('Удалить?')">
                        @csrf @method('DELETE')
                        <button style="background:#dc3545;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;font-size:.75rem;line-height:1;">✕</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="published" value="1" {{ old('published', $item?->published ?? true) ? 'checked' : '' }}>
                Опубликовать
            </label>
        </div>

        <div style="display:flex;gap:1rem;">
            <button type="submit" class="btn btn-primary">{{ $item ? 'Сохранить' : 'Добавить' }}</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<script>
function addMediaInput() {
    const wrap = document.getElementById('media-inputs');
    const input = document.createElement('input');
    input.type = 'file';
    input.name = 'media[]';
    input.accept = 'image/*,video/*';
    input.multiple = true;
    input.style.cssText = 'margin-bottom:.5rem;display:block;';
    wrap.appendChild(input);
}
</script>
@endsection
