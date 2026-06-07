@extends('layouts.app')

@section('content')
<style>
    .password-reset-page { min-height: calc(100vh - 140px); display: flex; align-items: center; justify-content: center; }
    .password-reset-card { max-width: 520px; width: 100%; border-radius: 28px; overflow: hidden; }
    .password-reset-header { background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #fff; padding: 1.75rem 2rem; }
    .password-reset-header h2 { margin: 0; font-size: 1.75rem; letter-spacing: -0.02em; }
    .password-reset-header p { margin: .75rem 0 0; color: rgba(255,255,255,.92); line-height: 1.6; }
    .password-reset-description { margin-bottom: 1.5rem; color: #334155; font-size: 0.98rem; }
    .password-reset-button { width: 100%; padding: 0.95rem 1.15rem; border-radius: 14px; font-size: 1rem; }
</style>
<div class="password-reset-page">
    <div class="password-reset-card card">
        <div class="password-reset-header">
            <h2>Обновление пароля</h2>
            <p>Введите новый пароль и подтвердите его для завершения восстановления доступа.</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Электронная почта</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Новый пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Подтвердите пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary password-reset-button">
                                    Сбросить пароль
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
