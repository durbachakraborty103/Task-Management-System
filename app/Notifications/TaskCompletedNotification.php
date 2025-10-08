<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCompletedNotification extends Notification implements ShouldQueue
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

    // Define the email content for task completion
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Completed: ' . $this->task->title)
            ->greeting('Great job ' . $notifiable->name . '! 🎉')
            ->line('You have successfully completed a task.')
            ->line('Completed Task: ' . $this->task->title)
            ->line('Description: ' . ($this->task->description ?: 'No description'))
            ->line('Priority: ' . ucfirst($this->task->priority))
            ->line('Completed on: ' . now()->format('M j, Y'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Keep up the good work!');
    }
}