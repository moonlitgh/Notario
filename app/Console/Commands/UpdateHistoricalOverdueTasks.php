<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class UpdateHistoricalOverdueTasks extends Command
{
    protected $signature = 'tasks:update-historical-overdue';
    protected $description = 'Update all historical tasks that are overdue but still pending';

    public function handle()
    {
        $updatedCount = Task::where('status', 'pending')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        $this->info("Updated {$updatedCount} historical overdue tasks.");
    }
} 