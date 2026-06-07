@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <h1>Клуб <span>«Ритм»</span></h1>
        <p>Современное социально-досуговое учреждение для детей и молодёжи Омска. Творчество, танцы, театр и общение.</p>
        <a href="{{ route('news') }}" class="btn">Наши новости</a>
        &nbsp;
        <a href="#about" class="btn btn-outline">О клубе</a>
    </div>
</section>

{{-- О КЛУБЕ --}}
<section id="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2>О клубе <span style="color:#e94560">«Ритм»</span></h2>
                <p>Клуб «Ритм» — это безопасное и дружелюбное пространство, где каждый ребёнок и молодой человек может раскрыть свои способности, найти друзей и интересно провести свободное время.</p>
                <p>Мы являемся частью Городского центра социальных услуг для детей и молодёжи города Омска и работаем как муниципальное бюджетное учреждение.</p>
                <p>Особое внимание уделяется поддержке детей, находящихся в трудной жизненной ситуации.</p>
            </div>
            <div class="about-stats">
                <div class="stat"><div class="num">4+</div><div class="label">Направления</div></div>
                <div class="stat"><div class="num">6</div><div class="label">Дней в неделю</div></div>
                <div class="stat"><div class="num">∞</div><div class="label">Возможностей</div></div>
                <div class="stat"><div class="num">0₽</div><div class="label">Муниципальное учреждение</div></div>
            </div>
        </div>
    </div>
</section>

{{-- НАПРАВЛЕНИЯ --}}
<section class="directions">
    <div class="container">
        <h2 class="section-title">Наши <span style="color:#9b59b6">направления</span></h2>
        <p class="section-sub">Кружки и секции для детей и молодёжи</p>
        <div class="dir-grid">
            <div class="dir-card">
                <div class="dir-icon">🎲</div>
                <h3>Игротека</h3>
                <p>Интеллектуальные и творческие игры для детей и подростков<br><small style="color:#9b59b6">Вт, Ср, Пт, Сб — 12:00–15:00 | 7–18 лет</small></p>
            </div>
            <div class="dir-card">
                <div class="dir-icon">🧵</div>
                <h3>Швейная мастерская</h3>
                <p>Шитьё и крой, лоскутная техника, макраме, вышивка<br><small style="color:#9b59b6">Ср, Пт — 16:00–17:00 | 10–35 лет</small></p>
            </div>
            <div class="dir-card">
                <div class="dir-icon">🏓</div>
                <h3>Настольный теннис</h3>
                <p>Развитие физической подготовки и основы игры в теннис<br><small style="color:#9b59b6">Вт, Сб — 15:00–16:00 | 7–35 лет</small></p>
            </div>
            <div class="dir-card">
                <div class="dir-icon">💃</div>
                <h3>Степ-аэробика</h3>
                <p>Зажигательные танцевальные движения на степ-платформе<br><small style="color:#9b59b6">Сб — 18:00–19:00 | 14–35 лет</small></p>
            </div>
            <div class="dir-card">
                <div class="dir-icon">🏃</div>
                <h3>Общая физподготовка</h3>
                <p>Развитие силы, быстроты реакции и выносливости<br><small style="color:#9b59b6">Сб, Вс — 10:00–12:00 | 10–15 лет</small></p>
            </div>
            <div class="dir-card">
                <div class="dir-icon">🎮</div>
                <h3>Игротека (16+)</h3>
                <p>Интеллектуальные и творческие игры для молодёжи<br><small style="color:#9b59b6">Сб, Вс — 12:00–20:00 | 16–35 лет</small></p>
            </div>
        </div>
        <p style="text-align:center;margin-top:2rem;color:#777;font-size:.9rem;">Все занятия бесплатны. Ответственный специалист: Садриева Римма Габдулловна</p>
    </div>
</section>

{{-- НОВОСТИ --}}
@if($news->count())
<section>
    <div class="container">
        <h2 class="section-title">Последние <span>новости</span></h2>
        <p class="section-sub">Жизнь клуба и события</p>
        <div class="cards">
            @foreach($news as $item)
            <div class="card">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect width=%22400%22 height=%22300%22 fill=%22%231e293b%22/%3E%3Ctext x=%2220%22 y=%22180%22 font-family=%22Inter,sans-serif%22 font-size=%2220%22 fill=%22%23cbd5e1%22%3EФото недоступно%3C/text%3E%3C/svg%3E';">
                @else
                    <div style="height:200px;background:linear-gradient(135deg,#1a1a2e,#0f3460);display:flex;align-items:center;justify-content:center;font-size:3rem;">🎭</div>
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
        <div style="text-align:center;margin-top:2rem;">
            <a href="{{ route('news') }}" class="btn">Все новости</a>
        </div>
    </div>
</section>
@endif

{{-- РАСПИСАНИЕ --}}
<section>
    <div class="container">
        <h2 class="section-title">Расписание <span style="color:#9b59b6">занятий</span></h2>
        <p class="section-sub">Все занятия бесплатны</p>
        <div style="overflow-x:auto;">
        <table class="schedule-table" style="max-width:700px;">
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">🎲 Игротека (дети и подростки)</td></tr>
            <tr><td>Расписание</td><td>Вт, Ср, Пт, Сб — 12:00–15:00</td></tr>
            <tr><td>Возраст</td><td>7–18 лет</td></tr>
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">🧵 Швейная мастерская</td></tr>
            <tr><td>Расписание</td><td>Ср, Пт — 16:00–17:00</td></tr>
            <tr><td>Возраст</td><td>10–35 лет</td></tr>
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">🏓 Настольный теннис</td></tr>
            <tr><td>Расписание</td><td>Вт, Сб — 15:00–16:00</td></tr>
            <tr><td>Возраст</td><td>7–35 лет</td></tr>
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">💃 Степ-аэробика</td></tr>
            <tr><td>Расписание</td><td>Сб — 18:00–19:00</td></tr>
            <tr><td>Возраст</td><td>14–35 лет</td></tr>
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">🏃 Общая физподготовка</td></tr>
            <tr><td>Расписание</td><td>Сб, Вс — 10:00–12:00</td></tr>
            <tr><td>Возраст</td><td>10–15 лет</td></tr>
            <tr style="background:#f0f2f5;"><td colspan="3" style="font-weight:800;color:#0d1b4b;padding:.8rem 1rem;">🎮 Игротека (молодёжь)</td></tr>
            <tr><td>Расписание</td><td>Сб, Вс — 12:00–20:00</td></tr>
            <tr><td>Возраст</td><td>16–35 лет</td></tr>
        </table>
        </div>
    </div>
</section>

{{-- КОНТАКТЫ --}}
<section id="contacts" style="background:#f8f9fa;">
    <div class="container">
        <h2 class="section-title">Наши <span style="color:#9b59b6">контакты</span></h2>
        <p class="section-sub">Приходите, мы всегда рады</p>
        <div class="contacts-grid">
            <div class="contact-card">
                <div class="icon">📍</div>
                <h4>Адрес</h4>
                <p>г. Омск, ул. Юбилейная, 6</p>
            </div>
            <div class="contact-card">
                <div class="icon">👩‍💼</div>
                <h4>Ответственный сотрудник</h4>
                <p>Садриева Римма Габдулловна</p>
                <p><a href="tel:+79507915269">8-950-791-52-69</a></p>
            </div>
            <div class="contact-card">
                <div class="icon">📞</div>
                <h4>Телефон клуба</h4>
                <p><a href="tel:+73812665580">+7 (3812) 66-55-80</a></p>
            </div>
            <div class="contact-card">
                <div class="icon">💬</div>
                <h4>Группа ВКонтакте</h4>
                <p><a href="https://vk.com" target="_blank">Группа ВК</a></p>
            </div>
            <div class="contact-card">
                <div class="icon">🌐</div>
                <h4>Сайт организации</h4>
                <p><a href="https://molodegka-55.ru" target="_blank">molodegka-55.ru</a></p>
            </div>
            <div class="contact-card">
                <div class="icon">🏢</div>
                <h4>Организация</h4>
                <p>Городской центр социальных услуг для детей и молодёжи</p>
            </div>
        </div>
    </div>
</section>

@endsection
