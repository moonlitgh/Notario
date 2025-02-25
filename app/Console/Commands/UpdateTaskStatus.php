<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update task status based on due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Update tasks yang due date-nya hari ini menjadi in_progress
        Task::where('status', '!=', 'completed')
            ->whereDate('due_date', '<=', $now)
            ->update(['status' => 'in_progress']);

        // Update tasks yang due date-nya belum hari ini menjadi pending
        Task::where('status', '!=', 'completed')
            ->whereDate('due_date', '>', $now)
            ->update(['status' => 'pending']);

        $this->info('Task status updated successfully!');
    }
}
