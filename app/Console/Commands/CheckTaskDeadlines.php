<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Mail\TaskDeadlineReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckTaskDeadlines extends Command
{
    protected $signature = 'tasks:check-deadlines';
    protected $description = 'Check task deadlines and send reminders';

    public function handle()
    {
        $this->info('Starting task deadline check...');
        
        // Check tasks due today (Hari H)
        $tasksToday = Task::where('status', '!=', 'completed')
            ->where('user_id', 5)
            ->whereDate('due_date', Carbon::today())
            ->get();

        $this->info('Found ' . $tasksToday->count() . ' tasks due today (Hari H)');
        
        foreach ($tasksToday as $task) {
            $this->sendEmailReminder($task, 'Hari H');
        }

        // Check tasks due tomorrow (H-1)
        $tasksTomorrow = Task::where('status', '!=', 'completed')
            ->where('user_id', 5)
            ->whereDate('due_date', Carbon::tomorrow())
            ->get();

        $this->info('Found ' . $tasksTomorrow->count() . ' tasks due tomorrow (H-1)');
        
        foreach ($tasksTomorrow as $task) {
            $this->sendEmailReminder($task, 'H-1');
        }

        // Check tasks due in 3 days (H-3)
        $tasksInThreeDays = Task::where('status', '!=', 'completed')
            ->where('user_id', 5)
            ->whereDate('due_date', Carbon::now()->addDays(3))
            ->get();

        $this->info('Found ' . $tasksInThreeDays->count() . ' tasks due in 3 days (H-3)');
        
        foreach ($tasksInThreeDays as $task) {
            $this->sendEmailReminder($task, 'H-3');
        }

        $this->info('Task deadline check completed!');
    }

    private function sendEmailReminder($task, $reminderType)
    {
        $this->info("Sending {$reminderType} email for task: {$task->title}");
        $this->info("Due date: {$task->due_date}");
        $this->info("User email: {$task->user->email}");
        
        try {
            Mail::to($task->user->email)->send(new TaskDeadlineReminder($task));
            $this->info("Email sent successfully for task: {$task->title}");
        } catch (\Exception $e) {
            $this->error("Failed to send email: " . $e->getMessage());
            Log::error("Email sending failed", [
                'task' => $task->id,
                'reminderType' => $reminderType,
                'error' => $e->getMessage()
            ]);
        }
    }
} 