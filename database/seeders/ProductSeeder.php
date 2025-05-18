<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Get all categories
        $categories = Category::all();

        // Get vendor(s) to assign products to
        $vendor = Vendor::first(); // Use first available vendor

        if (!$vendor) {
            $this->command->error('No vendors found! Please seed vendors first.');
            return;
        }

        for ($i = 1; $i <= 5; $i++) {
            $price = rand(100, 1000);
            $discount = rand(0, 50);
            $finalPrice = $price - ($price * $discount / 100);

            $product = Product::create([
                'id' => Str::random(15),
                'product_name' => "Product $i",
                'product_description' => "Description for product $i",
                'product_image' => "product_image_$i.png",
                'product_price' => $price,
                'discount_percent' => $discount,
                'final_price' => $finalPrice,
                'version' => '1.0.' . $i,
                'size_in_mb' => rand(10, 100),
                'platform' => ['android', 'ios', 'web'][array_rand(['android', 'ios', 'web'])],
                'type' => ['free', 'paid'][array_rand(['free', 'paid'])],
                'release_date' => now()->subDays(rand(0, 365)),
                'status' => 'active',
                'created_by' => $vendor->id, 
                'total_sold' => rand(0, 1000),
                'total_rating' => rand(0, 5000),
                'total_stock' => rand(0, 500),
                'total_review' => rand(0, 200),
                'average_rating' => rand(1, 50) / 10,
                'last_updated' => now(),
                'update_patch' => 'Initial release',
            ]);

            // Attach 3 random categories
            $product->categories()->attach(
                $categories->random(min(3, $categories->count()))->pluck('id')->toArray()
            );
        }
    }
}
