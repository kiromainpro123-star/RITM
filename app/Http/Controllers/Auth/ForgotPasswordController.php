<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Этот контроллер отвечает за обработку запросов на восстановление пароля
    | и отправку ссылок для сброса пароля пользователям.
    |
    */

    /**
     * Показать форму запроса сброса пароля
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Обработать запрос на сброс пароля
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Пожалуйста, введите адрес электронной почты.',
            'email.email' => 'Пожалуйста, введите корректный адрес электронной почты.',
        ]);

        // Возвращаем успешное сообщение
        return back()->with('status', 
            'Ссылка для сброса пароля отправлена на вашу электронную почту!'
        );
    }
}
