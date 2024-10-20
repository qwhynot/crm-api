<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
//        // Створюємо користувачів
//        User::create(['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => bcrypt('password')]);
//        User::create(['name' => 'Manager User', 'email' => 'manager@example.com', 'password' => bcrypt('password')]);
//        User::create(['name' => 'Employee User', 'email' => 'employee@example.com', 'password' => bcrypt('password')]);

        // Створюємо компанії
        $companyA = Company::create(['name' => 'Company A', 'address' => '123 Main St', 'phone' => '123-456-7890']);
        $companyB = Company::create(['name' => 'Company B', 'address' => '456 Market St', 'phone' => '098-765-4321']);

        // Створюємо клієнтів
        $client1 = Client::create(['company_id' => $companyA->id, 'name' => 'Client 1', 'email' => 'client1@example.com', 'phone' => '111-222-3333', 'address' => '789 Park Ave']);
        $client2 = Client::create(['company_id' => $companyB->id, 'name' => 'Client 2', 'email' => 'client2@example.com', 'phone' => '444-555-6666', 'address' => '101 Oak St']);

        // Створюємо проєкти
        $project1 = Project::create(['name' => 'Project 1', 'description' => 'Description for Project 1', 'status' => 'in_progress', 'start_date' => '2024-01-01', 'end_date' => '2024-06-01']);
        $project2 = Project::create(['name' => 'Project 2', 'description' => 'Description for Project 2', 'status' => 'planned', 'start_date' => '2024-03-01', 'end_date' => '2024-09-01']);

        // Створюємо завдання
        Task::create(['project_id' => $project1->id, 'assigned_to' => 2, 'title' => 'Task 1', 'description' => 'Description for Task 1', 'status' => 'pending', 'due_date' => '2024-05-01']);
        Task::create(['project_id' => $project2->id, 'assigned_to' => 3, 'title' => 'Task 2', 'description' => 'Description for Task 2', 'status' => 'in_progress', 'due_date' => '2024-07-01']);
    }
}
