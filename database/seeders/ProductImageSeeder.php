<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'game1.jpg',
            'game2.jpg',
            'game3.jpg',
            'game3.png',
            'game4.jpg',
            'game5.jpg',
            'game6.jpg',
        ];

        $sourceDir = public_path('System_image');
        $destDir = public_path('storage/product_images');

        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        foreach ($images as $img) {
            $src = $sourceDir . '/' . $img;
            $dst = $destDir . '/' . $img;
            if (File::exists($src) && !File::exists($dst)) {
                File::copy($src, $dst);
            }
        }

        $products = Product::all();

        foreach ($products as $product) {
            $mainImage = $images[array_rand($images)];

            DB::table('product_images')->insert([
                'product_id' => $product->id,
                'image_path' => 'product_images/' . $mainImage,
                'status' => 'main',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $subImages = collect($images)
                ->filter(fn($img) => $img !== $mainImage)
                ->shuffle()
                ->take(3);

            foreach ($subImages as $subImage) {
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image_path' => 'product_images/' . $subImage,
                    'status' => 'sub',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
