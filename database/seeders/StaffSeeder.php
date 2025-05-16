<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff; 

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample staff member
        Staff::create([
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'phone' => '0123456789',
            'address' => '123 Main St',
            'department' => 'IT',
            'position' => 'Developer',
            'date_of_birth' => '1990-01-01',
            'staff_nid' => 'NID123456',
            'staff_image' => null,
            'status' => 'active',
            'gender' => 'male',
            'emergency_contact' => '0987654321',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'spouse_name' => null,
            'role' => 'staff',
            'work_type' => 'full_time',
            'joining_date' => '2020-01-01',
            'bank_account_number' => '1234567890',
            'bank_name' => 'Bank Name',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Add more staff members if needed
        // Staff::factory(5)->create();  Uncomment if you have a factory
    }
}
