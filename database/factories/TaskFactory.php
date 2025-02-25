<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['pending', 'in_progress', 'completed', 'overdue']);
        
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'status' => $status,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_date' => $this->faker->dateTimeBetween('-1 week', '+2 weeks'),
        ];
    }
} 