<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Design database schema',
                'description' => 'Create the initial database schema for the project.',
                'status' => 'pending',
                'priority' => 'low',
                'due_date' => now(),
            ],
            [
                'title' => 'Implement user authentication',
                'description' => 'Set up user registration and login functionality.',
                'status' => 'pending',
                'priority' => 'low',
                'due_date' => now(),
            ],
        ];
        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
