<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset Your Password - Aarogyaa Bharat')
            ->greeting('Hello!')
            ->line('You requested a password reset. Click the button below to reset it.')
            ->action('Reset Password', url(route('admin.password.reset', $this->token, false)))
            ->line('If you did not request this, please ignore this email or contact support.')
            ->salutation('Best regards, Aarogyaa Bharat Team');
    }

}
