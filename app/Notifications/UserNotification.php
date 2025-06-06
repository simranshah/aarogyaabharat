<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotification extends Notification
{
    use Queueable;

    public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        // You can specify multiple channels here if needed, e.g., ['database', 'mail']
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,     // Title of the notification
            'message' => $this->message, // Message of the notification
        ];
    }
}
