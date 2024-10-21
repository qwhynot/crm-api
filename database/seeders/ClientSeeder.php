<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'company_id' => 1, // Прив'язка до першої компанії
                'name' => 'Client One',
                'email' => 'client.one@example.com',
                'phone' => '555-111-2222',
                'address' => '1234 Oak Street, Apartment 12',
                'website' => 'https://www.clientone.com',
                'tax_id' => 'CLNT123456',
                'registration_number' => 'CLNT987654',
                'city' => 'New York',
                'postal_code' => '10002',
                'notes' => 'Client prefers email communication.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 2, // Прив'язка до другої компанії
                'name' => 'Client Two',
                'email' => 'client.two@example.com',
                'phone' => '555-333-4444',
                'address' => '5678 Pine Street, Suite 45',
                'website' => 'https://www.clienttwo.com',
                'tax_id' => 'CLNT654321',
                'registration_number' => 'CLNT321987',
                'city' => 'Los Angeles',
                'postal_code' => '90001',
                'notes' => 'Client prefers phone communication.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 3, // Прив'язка до третьої компанії
                'name' => 'Client Three',
                'email' => 'client.three@example.com',
                'phone' => '555-555-6666',
                'address' => '9012 Birch Street, Floor 6',
                'website' => 'https://www.clientthree.com',
                'tax_id' => 'CLNT789123',
                'registration_number' => 'CLNT654789',
                'city' => 'Chicago',
                'postal_code' => '60601',
                'notes' => 'Client prefers in-person meetings.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
