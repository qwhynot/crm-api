<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'name' => 'Website Redesign',
                'description' => 'Redesign the company website for better user experience.',
                'status' => 'in_progress',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-01',
                'budget' => 50000,
                'created_by' => 1, // ID користувача, який створив проект
                'updated_by' => 1, // ID користувача, який редагував проект
                'notes' => 'Ensure that the redesign meets all accessibility standards.',
                'tags' => json_encode(['web', 'UX', 'design']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Develop a mobile app for online shopping.',
                'status' => 'planned',
                'start_date' => '2024-10-01',
                'end_date' => '2025-03-01',
                'budget' => 80000,
                'created_by' => 2,
                'updated_by' => 2,
                'notes' => 'Collaborate with the backend team for API integration.',
                'tags' => json_encode(['mobile', 'shopping', 'API']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marketing Campaign',
                'description' => 'Launch a marketing campaign to increase product awareness.',
                'status' => 'completed',
                'start_date' => '2024-01-15',
                'end_date' => '2024-05-15',
                'budget' => 30000,
                'created_by' => 3,
                'updated_by' => 3,
                'notes' => 'Evaluate the results and adjust future campaigns accordingly.',
                'tags' => json_encode(['marketing', 'campaign']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
