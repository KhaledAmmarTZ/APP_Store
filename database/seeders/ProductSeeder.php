<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Get all categories (you said you have 8)
        $categories = Category::all();

        // Get vendor(s) to assign products to
        $vendor = Vendor::first(); // Assuming you only have one vendor seeded as in your example

        if (!$vendor) {
            $this->command->error('No vendors found! Please seed vendors first.');
            return;
        }

        for ($i = 1; $i <= 5; $i++) {
            $product = Product::create([
                'product_name' => "Product $i",
                'product_description' => "Description for product $i",
                'product_image' => "product_image_$i.png",
                'product_price' => rand(100, 1000),
                'product_discount' => rand(0, 50),
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
                'average_rating' => rand(0, 5),
                'last_updated' => now(),
                'update_patch' => 'Initial release',
            ]);

            // Attach 3 random categories to each product
            $product->categories()->attach(
                $categories->random(3)->pluck('id')->toArray()
            );
        }
    }
}
