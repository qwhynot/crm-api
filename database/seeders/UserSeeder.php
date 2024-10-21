<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone_number' => '1234567890',
                'date_of_birth' => '1990-05-14',
                'address' => '123 Main St',
                'city' => 'New York',
                'postal_code' => '10001',
                'country' => 'USA',
                'is_admin' => true,
                'password' => Hash::make('password'), // Хешуємо пароль
            ],
            [
                'name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone_number' => '0987654321',
                'date_of_birth' => '1985-07-24',
                'address' => '456 Broadway',
                'city' => 'Los Angeles',
                'postal_code' => '90001',
                'country' => 'USA',
                'is_admin' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael.johnson@example.com',
                'phone_number' => '1122334455',
                'date_of_birth' => '1992-02-17',
                'address' => '789 Oak St',
                'city' => 'Chicago',
                'postal_code' => '60601',
                'country' => 'USA',
                'is_admin' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Emily',
                'last_name' => 'Davis',
                'email' => 'emily.davis@example.com',
                'phone_number' => '2233445566',
                'date_of_birth' => '1995-12-05',
                'address' => '1011 Pine St',
                'city' => 'San Francisco',
                'postal_code' => '94101',
                'country' => 'USA',
                'is_admin' => false,
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'William',
                'last_name' => 'Brown',
                'email' => 'william.brown@example.com',
                'phone_number' => '3344556677',
                'date_of_birth' => '1988-09-30',
                'address' => '1213 Maple St',
                'city' => 'Houston',
                'postal_code' => '77001',
                'country' => 'USA',
                'is_admin' => false,
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
