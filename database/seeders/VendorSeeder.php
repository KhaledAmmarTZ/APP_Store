<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create([
            'name' => 'Test Vendor',
            'email' => 'vendor@example.com',
            'role' => 'vendor',
            'company_name' => 'Test Company',
            'phone' => '0123456789',
            'address' => '123 Vendor St',
            'company_address' => '456 Company Ave',
            'business_license' => 'BL123456',
            'vendor_nid' => 'VNID123456',
            'vendor_image' => null,
            'bank_account_number' => '9876543210',
            'bank_name' => 'Vendor Bank',
            'password' => Hash::make('password123'), // Set a default password
            'email_verified_at' => now(),
            'status' => 'approved',
        ]);

        // Add more vendors if needed
        // Vendor::factory(5)->create(); // Uncomment if you have a factory
    }
}
