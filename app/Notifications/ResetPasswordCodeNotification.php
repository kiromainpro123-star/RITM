<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordCodeNotification extends Notification
{
    use Queueable;

    public string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Код для сброса пароля')
            ->greeting('Здравствуйте!')
            ->line('Вы запросили сброс пароля для вашей учётной записи.')
            ->line('Ваш код для восстановления: ' . $this->code)
            ->line('Введите этот код на странице восстановления пароля и создайте новый пароль.')
            ->line('Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо.');
    }
}
