<?php

namespace App\Models;

// -----------------------------------------------------------
// Import necessary Laravel classes
// -----------------------------------------------------------
use Illuminate\Database\Eloquent\Factories\HasFactory; // For creating test data with factories
use Illuminate\Foundation\Auth\User as Authenticatable; // Extends authentication features (login, register)
use Illuminate\Notifications\Notifiable;              // Adds notification support (emails, database alerts)
use Illuminate\Database\Eloquent\Relations\HasMany;   // For defining "has many" relationships

// -----------------------------------------------------------
// User Model - Represents a single user in the application
// -----------------------------------------------------------
class User extends Authenticatable
{
    // -------------------------------------------------------
    // Use traits:
    // - HasFactory: allows factory-based test data creation
    // - Notifiable: allows sending notifications to user
    // -------------------------------------------------------
    use HasFactory, Notifiable;
    
    // -------------------------------------------------------
    // 1. $fillable - Mass-assignable attributes
    // Protects against mass assignment vulnerabilities by
    // allowing only these fields to be bulk-inserted/updated.
    // -------------------------------------------------------
    protected $fillable = [
        'name',      // User's full name
        'email',     // User's email address
        'password',  // User's password (will be hashed automatically)
    ];

    // -------------------------------------------------------
    // 2. $hidden - Hide sensitive fields in arrays/JSON
    // This ensures password and remember_token do not appear
    // in API responses or when converting model to array.
    // -------------------------------------------------------
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // -------------------------------------------------------
    // 3. casts() - Automatically convert attributes
    // - email_verified_at -> converted to Carbon datetime
    // - password -> automatically hashed when saved
    // -------------------------------------------------------
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // lets you use ->diffForHumans()
            'password' => 'hashed',           // automatically bcrypts password
        ];
    }

    // -------------------------------------------------------
    // 4. Relationship: User HAS MANY tasks
    // This allows fetching all tasks for a user with:
    // $user->tasks
    //
    // FIXED: Changed foreign key from 'id' to 'user_id'
    // -------------------------------------------------------
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id');
    }
}