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
            'role' => 'staff',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Add more staff members if needed
        // Staff::factory(5)->create();  Uncomment if you have a factory
    }
}
