<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'completed',
        'user_id', 
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }
    // Add these scopes for filtering
public function scopeCompleted($query)
{
    return $query->where('is_completed', true);
}

public function scopePending($query)
{
    return $query->where('is_completed', false);
}

public function scopePriority($query, $priority)
{
    return $query->where('priority', $priority);
}

public function scopeDueDate($query, $date)
{
    return $query->whereDate('due_date', $date);
}
}