<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDueSoonNotification;
use Illuminate\Console\Command;

class SendTaskDueReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-due-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for tasks due within 24 hours';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Checking for tasks due soon...');

        // Get tasks due within 24 hours that are not completed
        $tasks = Task::dueSoon()->with('user')->get();
        
        $count = 0;
        
        foreach ($tasks as $task) {
            if ($task->user) {
                // Send notification to the assigned user
                $task->user->notify(new TaskDueSoonNotification($task));
                $count++;
                $this->info("Sent notification for task: {$task->title} to {$task->user->name}");
            }
        }

        if ($count > 0) {
            $this->info("Successfully sent {$count} due soon notifications.");
        } else {
            $this->info('No tasks due soon found.');
        }
        
        return 0;
    }
}