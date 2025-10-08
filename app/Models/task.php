<?php

namespace App\Models;

// Import necessary Laravel classes and traits
use Illuminate\Database\Eloquent\Factories\HasFactory; // Allows creation of test data via factories
use Illuminate\Database\Eloquent\Model;              // Base Eloquent model class
use Illuminate\Database\Eloquent\SoftDeletes;        // Enables soft delete feature (safe delete)
use App\Notifications\TaskAssignedNotification;      // Notification for when tasks are assigned
use App\Notifications\TaskDueSoonNotification;       // Notification for tasks due soon
use App\Notifications\TaskCompletedNotification;     // Notification for when tasks are completed

// Task Model - Represents a single "task" in your application
class Task extends Model
{
    // Use traits: HasFactory (for factories) and SoftDeletes
    use HasFactory, SoftDeletes;

    // 1. $fillable - List of attributes that are mass-assignable
    // This protects against mass assignment vulnerabilities.
    // Only these fields can be filled when using Task::create()
    protected $fillable = [
        'title',        // Task title
        'description',  // Task description/details
        'priority',     // Task priority (high/medium/low)
        'due_date',     // Task due date
        'completed',    // Whether task is completed (true/false)
        'user_id',      // The user who owns/assigned this task
    ];

    // 2. $casts - Define attribute type casting
    // Automatically converts attributes to specified types
    protected $casts = [
        'due_date' => 'datetime', // Convert due_date to Carbon instance for date operations
        'completed' => 'boolean', // Convert completed to boolean (true/false)
    ];

    // 3. Relationship: Each task BELONGS TO one user
    // This allows us to access the user who owns/assigned to this task using:
    // $task->user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    // 4. Model Events - Automatic actions when model is created/updated
    // This method runs when the model boots up (initializes)
    protected static function boot()
    {
        parent::boot();

        // Send notification when task is created/assigned
        static::created(function ($task) {
            if ($task->user) {
                // Notify the assigned user about their new task
                $task->user->notify(new TaskAssignedNotification($task));
            }
        });

        // Send notification when task assignee changes or task is completed
        static::updated(function ($task) {
            // Check if user_id was changed and task has a user
            if ($task->isDirty('user_id') && $task->user) {
                // Notify the newly assigned user about the task
                $task->user->notify(new TaskAssignedNotification($task));
            }
            
            // Check if task was just marked as completed and has a user
            if ($task->isDirty('completed') && $task->completed && $task->user) {
                // Notify the user that they completed the task
                $task->user->notify(new TaskCompletedNotification($task));
            }
        });
    }

    // 5. Helper Method: Check if task is due within 24 hours
    // Returns true if task is due soon but not yet overdue
    public function isDueSoon()
    {
        return $this->due_date->isFuture() && 
               $this->due_date->diffInDays(now()) <= 1; // Due within 24 hours
    }

    // 6. Query Scopes - Reusable filters to make querying tasks easy
    // Can call these like: Task::completed()->get();

    /**
     * Scope to get only completed tasks
     * Usage: Task::completed()->get()
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Scope to get only pending (not completed) tasks
     * Usage: Task::pending()->get()
     */
    public function scopePending($query)
    {
        return $query->where('completed', false);
    }

    /**
     * Scope to filter tasks by a given priority
     * Usage: Task::priority('high')->get()
     */
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope to filter tasks due on a specific date
     * Usage: Task::dueDate('2024-01-15')->get()
     */
    public function scopeDueDate($query, $date)
    {
        return $query->whereDate('due_date', $date);
    }

    /**
     * Scope to get tasks due within 24 hours (for notifications)
     * Filters: not completed, due in future, due within 1 day
     * Usage: Task::dueSoon()->get() - for sending due soon notifications
     */
    public function scopeDueSoon($query)
    {
        return $query->where('completed', false)           // Only pending tasks
                    ->where('due_date', '>', now())        // Not overdue (due in future)
                    ->where('due_date', '<=', now()->addDay()); // Due within 24 hours
    }

    // 7. Additional Helper Methods (Optional but useful)

    /**
     * Check if task is overdue (due date has passed but not completed)
     */
    public function isOverdue()
    {
        return !$this->completed && $this->due_date->isPast();
    }

    /**
     * Check if task is completed
     */
    public function isCompleted()
    {
        return $this->completed === true;
    }

    /**
     * Get tasks that are high priority
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }

    /**
     * Get tasks assigned to a specific user
     */
    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}