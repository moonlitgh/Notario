<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateRepeatingTasks extends Command
{
    protected $signature = 'tasks:generate-repeating';
    protected $description = 'Generate repeating tasks';

    public function handle()
    {
        $tasks = Task::whereIn('repetition', ['weekly', 'monthly', 'yearly'])
            ->where(function ($query) {
                $query->whereNull('last_generated_date')
                    ->orWhere('last_generated_date', '<', Carbon::now()->subDay());
            })
            ->get();

        foreach ($tasks as $task) {
            $this->generateNextTask($task);
        }

        $this->info('Repeating tasks generated successfully!');
    }

    private function generateNextTask($task)
    {
        $nextDueDate = match ($task->repetition) {
            'weekly' => $task->due_date->addWeek(),
            'monthly' => $task->due_date->addMonth(),
            'yearly' => $task->due_date->addYear(),
            default => null
        };

        if ($nextDueDate && $nextDueDate->isFuture()) {
            Task::create([
                'title' => $task->title,
                'description' => $task->description,
                'status' => 'pending',
                'priority' => $task->priority,
                'due_date' => $nextDueDate,
                'user_id' => $task->user_id,
                'repetition' => $task->repetition
            ]);

            $task->update(['last_generated_date' => Carbon::now()]);
        }
    }
} 