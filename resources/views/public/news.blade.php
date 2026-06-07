@extends('layouts.public')

@section('content')
<section style="background:#0d1b4b;padding:3rem 2rem;text-align:center;">
    <h1 style="color:#fff;font-size:2.2rem;font-weight:800;">Новости <span style="color:#9b59b6">клуба</span></h1>
</section>

<style>
.news-card { background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,.07); transition:transform .2s,box-shadow .2s; }
.news-card:hover { transform:translateY(-4px); box-shadow:0 8px 24px rgba(0,0,0,.12); }
.mini-grid { display:grid; gap:2px; }
.mini-grid.g1 { grid-template-columns:1fr; }
.mini-grid.g2 { grid-template-columns:1fr 1fr; }
.mini-grid.g3 { grid-template-columns:1fr 1fr; }
.mini-grid.g3 .gi:first-child { grid-column:1/3; }
.mini-grid.g4 { grid-template-columns:1fr 1fr; }
.gi { aspect-ratio:4/3; overflow:hidden; }
.gi img { width:100%;height:100%;object-fit:cover;display:block; }
</style>

<section>
    <div class="container">
        @if($news->count())
        <div class="cards">
            @foreach($news as $item)
            @php
                $imgs = $item->media->where('type','image')->values();
                $allImgs = collect();
                if($item->image) $allImgs->push($item->image);
                foreach($imgs as $m) $allImgs->push('storage/'.$m->file);
                $cnt = min($allImgs->count(), 4);
            @endphp
            <div class="news-card">
                @if($allImgs->count())
                <div class="mini-grid g{{ $cnt }}">
                    @foreach($allImgs->take(4) as $src)
                    @php $photoUrl = str_starts_with($src, 'storage/') ? asset($src) : asset('storage/' . ltrim($src, '/')); @endphp
                    <div class="gi"><img src="{{ $photoUrl }}" alt="{{ $item->title }}" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect width=%22400%22 height=%22300%22 fill=%22%23e2e8f0%22/%3E%3Ctext x=%2220%22 y=%22180%22 font-family=%22Inter,sans-serif%22 font-size=%2220%22 fill=%22%23606f7a%22%3EФото недоступно%3C/text%3E%3C/svg%3E';"></div>
                    @endforeach
                </div>
                @else
                <div style="height:180px;background:linear-gradient(135deg,#0d1b4b,#1a2a6c);display:flex;align-items:center;justify-content:center;font-size:3rem;">🎭</div>
                @endif
                <div class="card-body">
                    <div class="card-date">{{ $item->created_at->format('d.m.Y') }}</div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ Str::limit($item->content, 100) }}</p>
                    <a href="{{ route('news.show', $item->id) }}" class="card-link">Читать →</a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:2rem;">{{ $news->links() }}</div>
        @else
        <p style="text-align:center;color:#777;padding:3rem 0;">Новостей пока нет</p>
        @endif
    </div>
</section>
@endsection
