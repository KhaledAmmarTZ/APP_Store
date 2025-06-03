<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();


        $reviews = [];
        for ($i = 0; $i < 20; $i++) {
            $productId = $productIds[array_rand($productIds)];
            $userId = $userIds[array_rand($userIds)];

            if (collect($reviews)->contains(fn($r) => $r['user_id'] === $userId && $r['product_id'] === $productId)) {
                continue;
            }

            $reviews[] = [
                'product_id' => $productId,
                'user_id' => $userId,
                'rating' => rand(1, 5),
                'comment' => Str::random(30),
                'review_date' => Carbon::now()->subDays(rand(0, 30))->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('reviews')->insert($reviews);
    }
}