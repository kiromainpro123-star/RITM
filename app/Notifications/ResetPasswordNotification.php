<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Сброс пароля')
            ->greeting('Здравствуйте!')
            ->line('Вы получили это письмо, потому что был запрошен сброс пароля для вашей учетной записи.')
            ->action('Сбросить пароль', $url)
            ->line('Ссылка будет действительна в течение ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' минут.')
            ->line('Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.');
    }
}
