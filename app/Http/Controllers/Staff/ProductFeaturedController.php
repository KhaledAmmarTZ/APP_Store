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

        Product::query()->update(['is_featured' => 'no', 'is_free' => 'no']);

        if ($request->has('featured_ids')) {
            Product::whereIn('id', $request->featured_ids)->update(['is_featured' => 'yes']);
        }

        if ($request->has('free_ids')) {
            Product::whereIn('id', $request->free_ids)->update(['is_free' => true]);
        }

        return back()->with('success', 'Featured and free products updated successfully.');
    }
}