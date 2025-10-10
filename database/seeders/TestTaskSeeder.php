<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestTaskSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        
        if ($user) {
            Task::create([
                'title' => 'Test Due Task',
                'due_date' => now()->subMinutes(5), // Use due_date (not duedate)
                'completed' => false,
                'user_id' => $user->id,
                'reminder_sent' => false,
                'priority' => 'high'
                // Don't include 'description' column - it doesn't exist
            ]);
            
            $this->command->info('Test task created for user: ' . $user->email);
        } else {
            $this->command->error('No user found!');
        }
    }
}