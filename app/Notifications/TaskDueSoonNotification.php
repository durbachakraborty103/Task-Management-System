<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDueSoonNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Task $task)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Due Notification')
            ->greeting('Dear ' . $notifiable->name . ',')
            ->line('We would like to inform you that one of your assigned tasks has reached its due date.')
            ->line('Your timely completion of this task would be greatly appreciated.')
            ->action('Access Task', url('/tasks/' . $this->task->id))
            ->line('Please let us know if you need any assistance or if there are any constraints.')
            ->salutation('Sincerely, Your Task Management System');
    }
}