@extends('layouts.public')

@section('content')
<section style="background:#1a1a2e;padding:3rem 2rem;text-align:center;">
    <h1 style="color:#fff;font-size:2.2rem;font-weight:800;">Галерея <span style="color:#e94560">клуба</span></h1>
</section>

<section>
    <div class="container">
        @if($photos->count())
        <div class="gallery-grid">
            @foreach($photos as $photo)
                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title ?? 'Фото' }}" title="{{ $photo->title }}" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect width=%22400%22 height=%22300%22 fill=%22%23e2e8f0%22/%3E%3Ctext x=%2220%22 y=%22180%22 font-family=%22Inter,sans-serif%22 font-size=%2220%22 fill=%22%23606f7a%22%3EФото недоступно%3C/text%3E%3C/svg%3E';">
            @endforeach
        </div>
        <div style="margin-top:2rem;">{{ $photos->links() }}</div>
        @else
        <p style="text-align:center;color:#777;padding:3rem 0;">Фотографий пока нет</p>
        @endif
    </div>
</section>
@endsection
