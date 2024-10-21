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
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
