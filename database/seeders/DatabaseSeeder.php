<?php

namespace Database\Seeders;

// use Illuminate\Database\Seeder; (removed duplicate)
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate tables (optional)
        // DB::table('users')->truncate();
        // DB::table('staff')->truncate();
        // DB::table('admins')->truncate();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'date_of_birth' => '1995-01-01',
            'gender' => 'male',
            'address' => '123 Main St',
            'nationality' => 'Country',
            'status' => 'active',
            'role' => 'user',
            'phoneNumber' => '0123456789',
            'place' => 'City',
            'user_nid' => 'NID123456',
            'user_image' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
        ]);

        $this->call([
            AdminSeeder::class,
            StaffSeeder::class,
            VendorSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            ReviewSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
