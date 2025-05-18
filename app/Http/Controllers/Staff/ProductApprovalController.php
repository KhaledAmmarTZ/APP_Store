<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApprovalController extends Controller
{
    // List all pending products
    public function index()
    {
        $pendingProducts = Product::where('status', 'pending')->get();
        return view('staff.products.pending', compact('pendingProducts'));
    }

    // Approve product
    public function approve(Product $product)
    {
        $product->status = 'active';
        $product->save();

        return redirect()->route('staff.products.pending')->with('success', 'Product approved successfully.');
    }

    // Reject product
    public function reject(Product $product)
    {
        $product->status = 'suspended';
        $product->save();

        return redirect()->route('staff.products.pending')->with('success', 'Product rejected.');
    }
}
