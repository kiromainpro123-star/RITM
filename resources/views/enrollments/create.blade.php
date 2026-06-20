@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Запись на кружок</div>
                <div class="card-body">
                    <p>Заполните форму, чтобы записать ребёнка на одно из наших занятий.</p>
                    <form method="POST" action="{{ route('enroll.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="child_name" class="form-label">Имя ребёнка</label>
                            <input id="child_name" type="text" class="form-control @error('child_name') is-invalid @enderror" name="child_name" value="{{ old('child_name') }}" required maxlength="100" placeholder="Иван Иванов" oninput="this.value=this.value.replace(/[^а-яёА-ЯЁa-zA-Z\s\-]/g,'')">
                            @error('child_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="child_age" class="form-label">Возраст</label>
                            <input id="child_age" type="number" class="form-control @error('child_age') is-invalid @enderror" name="child_age" value="{{ old('child_age') }}" required min="3" max="25" placeholder="от 3 до 25 лет">
                            @error('child_age')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="club" class="form-label">Кружок / направление</label>
                            <select id="club" name="club" class="form-select @error('club') is-invalid @enderror" required>
                                <option value="">Выберите направление</option>
                                <option value="Игротека" {{ old('club') == 'Игротека' ? 'selected' : '' }}>Игротека</option>
                                <option value="Швейная мастерская" {{ old('club') == 'Швейная мастерская' ? 'selected' : '' }}>Швейная мастерская</option>
                                <option value="Настольный теннис" {{ old('club') == 'Настольный теннис' ? 'selected' : '' }}>Настольный теннис</option>
                                <option value="Степ-аэробика" {{ old('club') == 'Степ-аэробика' ? 'selected' : '' }}>Степ-аэробика</option>
                                <option value="Общая физподготовка" {{ old('club') == 'Общая физподготовка' ? 'selected' : '' }}>Общая физподготовка</option>
                                <option value="Игротека 16+" {{ old('club') == 'Игротека 16+' ? 'selected' : '' }}>Игротека 16+</option>
                            </select>
                            @error('club')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="parent_phone" class="form-label">Телефон родителя</label>
                            <input id="parent_phone" type="tel" class="form-control @error('parent_phone') is-invalid @enderror" name="parent_phone" value="{{ old('parent_phone') }}" required placeholder="+7 (999) 999-99-99" pattern="[\+\d\s\-\(\)]+" oninput="this.value=this.value.replace(/[^+\d\s\-\(\)]/g,'')">
                            @error('parent_phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Комментарий</label>
                            <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4" maxlength="1000" placeholder="Дополнительная информация (необязательно)">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Отправить заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
