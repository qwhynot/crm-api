<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Tech Solutions LLC',
                'address' => '1234 Elm Street, Suite 567',
                'phone' => '123-456-7890',
                'email' => 'info@techsolutions.com',
                'website' => 'https://www.techsolutions.com',
                'tax_id' => Str::random(10),
                'registration_number' => 'ABC123456',
                'country' => 'USA',
                'city' => 'New York',
                'postal_code' => '10001',
                'industry' => 'Technology',
                'description' => 'Leading tech company specializing in software solutions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green Energy Corp',
                'address' => '7890 Maple Drive, Suite 123',
                'phone' => '987-654-3210',
                'email' => 'contact@greenenergy.com',
                'website' => 'https://www.greenenergy.com',
                'tax_id' => Str::random(10),
                'registration_number' => 'DEF654321',
                'country' => 'Canada',
                'city' => 'Toronto',
                'postal_code' => 'M5V 2T6',
                'industry' => 'Energy',
                'description' => 'Innovative company providing sustainable energy solutions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Global Finance Inc.',
                'address' => '5678 Oak Street, Floor 9',
                'phone' => '555-123-4567',
                'email' => 'support@globalfinance.com',
                'website' => 'https://www.globalfinance.com',
                'tax_id' => Str::random(10),
                'registration_number' => 'GHI987654',
                'country' => 'United Kingdom',
                'city' => 'London',
                'postal_code' => 'SW1A 1AA',
                'industry' => 'Finance',
                'description' => 'Financial services and investment company.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Healthcare Solutions Ltd.',
                'address' => '9012 Pine Street, Apt 4B',
                'phone' => '444-555-6666',
                'email' => 'sales@healthcaresolutions.com',
                'website' => 'https://www.healthcaresolutions.com',
                'tax_id' => Str::random(10),
                'registration_number' => 'JKL321987',
                'country' => 'Australia',
                'city' => 'Sydney',
                'postal_code' => '2000',
                'industry' => 'Healthcare',
                'description' => 'Leading provider of healthcare services and products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Digital Marketing Group',
                'address' => '3456 Birch Street, Suite 202',
                'phone' => '222-333-4444',
                'email' => 'info@dmgroup.com',
                'website' => 'https://www.dmgroup.com',
                'tax_id' => Str::random(10),
                'registration_number' => 'MNO654123',
                'country' => 'Germany',
                'city' => 'Berlin',
                'postal_code' => '10115',
                'industry' => 'Marketing',
                'description' => 'Full-service digital marketing agency.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
