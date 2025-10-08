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

    // Store the task instance
    public function __construct(public Task $task)
    {
        // Constructor receives the task and makes it available to the notification
    }

    // Define which channels to send the notification through
    public function via(object $notifiable): array
    {
        return ['mail']; // Send via email only
    }

    // Define the email content for due soon reminder
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reminder: Task Due Soon - ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('This is a reminder that your task is due soon.')
            ->line('Task: ' . $this->task->title)
            ->line('Due Date: ' . $this->task->due_date->format('M j, Y'))
            ->line('Priority: ' . ucfirst($this->task->priority))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Please complete it before the deadline.');
    }
}