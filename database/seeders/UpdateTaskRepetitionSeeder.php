<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class UpdateTaskRepetitionSeeder extends Seeder
{
    public function run()
    {
        // Update semua task yang belum memiliki repetition menjadi 'none'
        Task::whereNull('repetition')
            ->orWhere('repetition', '')
            ->update(['repetition' => 'none']);
    }
} 