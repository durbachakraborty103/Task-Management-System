<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {   return (new MailMessage)
                ->subject('Task Due Notification')
                ->greeting('Dear ' . $notifiable->name . ',')
                ->line('We would like to inform you that one of your assigned tasks has reached its due date.')
                ->line('Your timely completion of this task would be greatly appreciated.')
                ->action('Access Task', url('/tasks'))
                ->line('Please let us know if you need any assistance or if there are any constraints.')
                ->salutation('Sincerely, Your Task Management System');
    }
    }