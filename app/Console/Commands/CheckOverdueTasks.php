<?php

namespace App\Console\Commands;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOverdueTasks extends Command
{
    protected $signature = 'tasks:check-overdue';
    protected $description = 'Check and update overdue tasks';

    public function handle()
    {
        Task::where('status', '!=', 'completed')
            ->where('due_date', '<', Carbon::now())
            ->update(['status' => 'overdue']);

        $this->info('Overdue tasks have been updated!');
    }
} 