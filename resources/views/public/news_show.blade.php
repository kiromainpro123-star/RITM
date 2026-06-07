@extends('layouts.public')

@section('content')
<section>
    <div class="container" style="max-width:800px;">
        <a href="{{ route('news') }}" style="color:#1a3a8c;font-weight:700;">← Назад к новостям</a>
        <h1 style="font-size:2rem;font-weight:800;margin:1.5rem 0 .5rem;">{{ $item->title }}</h1>
        <p style="color:#999;margin-bottom:1.5rem;">{{ $item->created_at->format('d.m.Y') }}</p>

        {{-- Медиа сетка как в ВК --}}
        @php
            $images = $item->media->where('type', 'image')->values();
            $videos = $item->media->where('type', 'video')->values();
            $count = $images->count();
        @endphp

        @if($item->image || $count > 0)
        @php
            $mediaCount = min($count + ($item->image ? 1 : 0), 4);
            $extraCount = max($count - 3, 0);
            $displayImages = $item->image ? $images->take(3) : $images->take(4);
        @endphp
        <div class="media-grid media-{{ $mediaCount }}" style="margin-bottom:1.5rem;">
            @if($item->image)
                <div class="media-item" onclick="openLightbox('{{ asset('storage/' . $item->image) }}')">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect width=%22400%22 height=%22300%22 fill=%22%23e2e8f0%22/%3E%3Ctext x=%2220%22 y=%22180%22 font-family=%22Inter,sans-serif%22 font-size=%2220%22 fill=%22%23606f7a%22%3EФото недоступно%3C/text%3E%3C/svg%3E';">
                </div>
            @endif
            @foreach($displayImages as $index => $m)
                @php $isMoreCell = $item->image ? $index === 2 && $count > 3 : $index === 3 && $count > 4; @endphp
                <div class="media-item{{ $isMoreCell ? ' media-more' : '' }}" onclick="openLightbox('{{ asset('storage/' . $m->file) }}')">
                    <img src="{{ asset('storage/' . $m->file) }}" alt="" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect width=%22400%22 height=%22300%22 fill=%22%23e2e8f0%22/%3E%3Ctext x=%2220%22 y=%22180%22 font-family=%22Inter,sans-serif%22 font-size=%2220%22 fill=%22%23606f7a%22%3EФото недоступно%3C/text%3E%3C/svg%3E';">
                    @if($isMoreCell && $extraCount > 0)
                        <div class="more-overlay">+{{ $extraCount }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        {{-- Видео --}}
        @foreach($videos as $v)
        <video controls style="width:100%;border-radius:10px;margin-bottom:1rem;max-height:450px;background:#000;">
            <source src="{{ asset('storage/' . $v->file) }}">
        </video>
        @endforeach

        <div style="line-height:1.9;color:#444;font-size:1.05rem;">
            {!! nl2br(e($item->content)) !!}
        </div>
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" onclick="closeLightbox()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.9);z-index:9999;align-items:center;justify-content:center;cursor:zoom-out;">
    <img id="lightbox-img" src="" style="max-width:95vw;max-height:95vh;border-radius:8px;object-fit:contain;">
</div>

<style>
.media-grid { display:grid; gap:4px; border-radius:12px; overflow:hidden; }
.media-grid.media-1 { grid-template-columns:1fr; }
.media-grid.media-2 { grid-template-columns:1fr 1fr; }
.media-grid.media-3 { grid-template-columns:1fr 1fr; grid-template-rows:auto auto; }
.media-grid.media-3 .media-item:first-child { grid-column:1/3; }
.media-grid.media-4 { grid-template-columns:1fr 1fr; grid-template-rows:1fr 1fr; }
.media-item { position:relative; overflow:hidden; cursor:zoom-in; aspect-ratio:4/3; }
.media-item img { width:100%; height:100%; object-fit:cover; transition:transform .2s; display:block; }
.media-item:hover img { transform:scale(1.03); }
.more-overlay { position:absolute;inset:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;font-weight:800; }
</style>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>
@endsection
