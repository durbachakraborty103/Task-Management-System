<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification implements ShouldQueue
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

    // Define the email content
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Task Assigned: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('You have been assigned a new task.')
            ->line('Task: ' . $this->task->title)
            ->line('Description: ' . ($this->task->description ?: 'No description'))
            ->line('Priority: ' . ucfirst($this->task->priority))
            ->line('Due Date: ' . $this->task->due_date->format('M j, Y'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Thank you for using our application!');
    }
}