@extends('layouts.app')

@section('content')
<style>
    .reset-password-container {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .reset-password-card {
        max-width: 480px;
        width: 100%;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
        background: #ffffff;
    }

    .reset-password-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #ffffff;
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .reset-password-header h2 {
        margin: 0;
        font-size: 1.75rem;
        letter-spacing: -0.02em;
        font-weight: 700;
    }

    .reset-password-header p {
        margin: 0.75rem 0 0;
        color: rgba(255, 255, 255, 0.92);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .reset-password-body {
        padding: 2rem 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #111827;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.9rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 14px;
        font-size: 1rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        outline: none;
        border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.12);
        background: #ffffff;
    }

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        color: #b91c1c;
        font-size: 0.9rem;
    }

    .info-text {
        background: #eef2ff;
        border-left: 4px solid #8b5cf6;
        color: #34435c;
        padding: 1rem;
        border-radius: 14px;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .alert-success {
        background: #d1fae5;
        border-left: 4px solid #10b981;
        color: #065f46;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.25rem;
        font-size: 0.95rem;
    }

    .alert-danger {
        background: #fee2e2;
        border-left: 4px solid #ef4444;
        color: #7f1d1d;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.25rem;
        font-size: 0.95rem;
    }

    .btn-reset {
        width: 100%;
        padding: 0.95rem 1rem;
        border: none;
        border-radius: 14px;
        color: #ffffff;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-reset:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 25px rgba(79, 70, 229, 0.18);
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 1.75rem 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e5e7eb;
    }

    .divider-text {
        position: relative;
        display: inline-block;
        background: #ffffff;
        padding: 0 0.75rem;
        color: #6b7280;
        font-size: 0.85rem;
        font-weight: 600;
    }
</style>

<div class="reset-password-container">
    <div class="reset-password-card">
        <div class="reset-password-header">
            <h2>Сброс пароля</h2>
            <p>Введите электронную почту вашей учётной записи, и мы отправим ссылку для восстановления.</p>
        </div>

        <div class="reset-password-body">
            @if (session('status'))
                <div class="alert-success">
                    ✓ {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert-danger">✕ {{ $error }}</div>
                @endforeach
            @endif

            <div class="info-text">
                📧 Введите вашу электронную почту для восстановления доступа к аккаунту.
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Электронная почта</label>
                    <input
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="пример@почта.ru"
                        required
                        autofocus
                    />
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-reset">Отправить ссылку на почту</button>
            </form>

            <!-- Информационный блок удалён по просьбе — инструкции даются в чате -->
        </div>
    </div>
</div>

@endsection
