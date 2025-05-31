<?php
// filepath: app\Http\Controllers\Staff\ProductFeaturedController.php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductFeaturedController extends Controller
{
    /**
     * Show the form for selecting featured products.
     */
    public function index()
    {
        $products = Product::all();
        return view('staff.products.featured', compact('products'));
    }

    /**
     * Update the is_featured column for selected products.
     */
    public function update(Request $request)
    {
        $request->validate([
            'featured_ids' => 'array|max:6',
            'featured_ids.*' => 'exists:products,id',
            'free_ids' => 'array',
            'free_ids.*' => 'exists:products,id',
        ]);

        Product::query()->update(['is_featured' => 'no']);

        if ($request->has('featured_ids')) {
            Product::whereIn('id', $request->featured_ids)->update(['is_featured' => 'yes']);
        }

        $allIds = Product::pluck('id')->toArray();
        $freeIds = $request->input('free_ids', []);

        if (!empty($freeIds)) {
            Product::whereIn('id', $freeIds)->get()->each(function ($product) {
                if ($product->is_free !== 'yes') {
                    $product->original_price = $product->product_price;
                    $product->product_price = 0;
                    $product->final_price = 0; 
                    $product->is_free = 'yes';
                    $product->save();
                }
            });
        }

        $notFreeIds = array_diff($allIds, $freeIds);
        if (!empty($notFreeIds)) {
            Product::whereIn('id', $notFreeIds)->get()->each(function ($product) {
                if ($product->is_free === 'yes') {
                    if ($product->original_price !== null) {
                        $product->product_price = $product->original_price;
                        $discount = floatval($product->discount_percent ?? 0);
                        $price = floatval($product->original_price);
                        $product->final_price = round($price - ($price * $discount / 100), 2);
                    }
                    $product->is_free = 'no';
                    $product->save();
                }
            });
        }

        return back()->with('success', 'Featured and free products updated successfully.');
    }
}