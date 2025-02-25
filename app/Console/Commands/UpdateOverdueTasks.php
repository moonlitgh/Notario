<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class UpdateOverdueTasks extends Command
{
    protected $signature = 'tasks:update-overdue';
    protected $description = 'Update status of overdue tasks';

    public function handle()
    {
        Task::where('status', 'pending')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        $this->info('Overdue tasks have been updated.');
    }
} 