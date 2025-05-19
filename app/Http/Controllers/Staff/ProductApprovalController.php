<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductApprovalController extends Controller
{
    // List all pending products
    public function index()
    {
        $staffId = Auth::guard('staff')->id();
        $pendingProducts = Product::where('status', 'pending')->get();
        return view('staff.products.pending', compact('pendingProducts'));
    }

    // Approve product
    public function approve(Product $product)
    {
        $staffId = Auth::guard('staff')->id();
        $product->status = 'active';
        $product->checked_by = $staffId; 
        $product->save();

        return redirect()->route('staff.products.pending')->with('success', 'Product approved successfully.');
    }

    // Reject product
    public function reject(Product $product)
    {
        $staffId = Auth::guard('staff')->id();
        $product->status = 'suspended';
        $product->checked_by = $staffId;
        $product->save();

        return redirect()->route('staff.products.pending')->with('success', 'Product rejected.');
    }
}
