<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'project_id' => 2,
                'assigned_to' => 1,
                'title' => 'Design homepage layout',
                'description' => 'Create a user-friendly layout for the homepage with responsive design.',
                'status' => 'in_progress',
                'due_date' => '2024-10-30',
                'priority' => 'high',
                'created_by' => 1,
                'updated_by' => 1,
                'completed_at' => null, // Задача ще не завершена
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'assigned_to' => 2,
                'title' => 'API integration for shopping cart',
                'description' => 'Integrate payment gateway API for shopping cart functionality.',
                'status' => 'pending',
                'due_date' => '2024-11-15',
                'priority' => 'medium',
                'created_by' => 2,
                'updated_by' => 2,
                'completed_at' => null, // Задача ще не завершена
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 3,
                'assigned_to' => null, // Немає призначеного користувача
                'title' => 'Prepare final campaign report',
                'description' => 'Compile and analyze data from the marketing campaign for review.',
                'status' => 'completed',
                'due_date' => '2024-05-20',
                'priority' => 'low',
                'created_by' => 3,
                'updated_by' => 3,
                'completed_at' => '2024-05-18 14:30:00', // Задача завершена
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
