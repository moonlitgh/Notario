<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CheckTaskDeadlines;
use App\Console\Commands\UpdateHistoricalOverdueTasks;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('tasks:update-status')->everyMinute();
        $schedule->command('tasks:generate-repeating')->daily();
        $schedule->command('tasks:check-deadlines')->dailyAt('09:00');
        $schedule->command('tasks:check-overdue')->hourly();
        $schedule->command('tasks:update-overdue')->hourly();
    }

    protected $commands = [
        CheckTaskDeadlines::class,
        UpdateHistoricalOverdueTasks::class,
    ];
} 