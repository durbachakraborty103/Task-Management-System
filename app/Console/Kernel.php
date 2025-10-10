<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * This runs scheduled tasks automatically
     */
    protected function schedule(Schedule $schedule)
    {
        // ✅ Schedule due reminders to run EVERY MINUTE
        // This ensures tasks get notifications exactly when they're due
        $schedule->command('tasks:send-due-reminders')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}