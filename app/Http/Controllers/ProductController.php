<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the logged-in vendor's ID
        $vendorId = Auth::guard('vendor')->id();

        // Fetch all products belonging to this vendor
        $products = Product::where('created_by', $vendorId)->get();

        // Pass products to the view
        return view('vendor.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('vendor.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string|max:65535',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'product_price' => 'required|numeric|min:0|max:99999999.99',
            'product_discount' => 'nullable|numeric|min:0|max:99999999.99',
            'version' => 'required|string|max:255',
            'size_in_mb' => 'nullable|numeric|min:0|max:999999.99',
            'platform' => 'required|in:android,ios,web',
            'type' => 'required|in:free,paid',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'update_patch' => 'nullable|string|max:65535',
        ]);

        // Handle image upload if exists
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
        }

        // Generate unique product id manually (since id is string and non-incrementing)
        do {
            $productId = Str::random(15);
        } while (Product::where('id', $productId)->exists());

        // Create product
        $product = Product::create([
            'id' => $productId,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_image' => $imagePath,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount ?? 0,
            'version' => $request->version,
            'size_in_mb' => $request->size_in_mb,
            'platform' => $request->platform,
            'type' => $request->type,
            'release_date' => now(),
            'status' => 'pending', // default pending status
            'created_by' => Auth::guard('vendor')->id(),
            'total_sold' => 0,
            'total_rating' => 0,
            'total_stock' => 0,
            'total_review' => 0,
            'average_rating' => 0,
            'last_updated' => now(),
            'update_patch' => null,
        ]);


        // Attach categories
        $product->categories()->attach($request->categories);

        return redirect()->route('vendor.products.create')->with('success', 'Product added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
    
}
