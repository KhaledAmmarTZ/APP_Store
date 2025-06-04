<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        $reasons = [
            'Inappropriate content',
            'Spam or misleading',
            'Copyright violation',
            'Broken or not working',
            'Other'
        ];

        $reports = [];
        for ($i = 0; $i < 20; $i++) {
            $productId = $productIds[array_rand($productIds)];
            $userId = $userIds[array_rand($userIds)];

            // Simulate a random report time in the last 10 days
            $reportedAt = Carbon::now()->subDays(rand(0, 10))->toDateTimeString();

            $reports[] = [
                'user_id' => $userId,
                'product_id' => $productId,
                'reason' => $reasons[array_rand($reasons)],
                'reported_at' => $reportedAt,
                'created_at' => $reportedAt,
                'updated_at' => $reportedAt,
            ];
        }

        DB::table('reports')->insert($reports);
    }
}