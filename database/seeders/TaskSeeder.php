<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a test user
        $user = User::first() ?? User::factory()->create();

        // Create tasks using factory
        Task::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id
            ]);
    }
}
