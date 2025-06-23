<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
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
        $vendorId = Auth::guard('vendor')->id();
        $products = Product::where('created_by', $vendorId)->get();
        return view('vendor.products.index', compact('products'));
    }

    public function adminindex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    
    public function showVendor($id)
    {
        $vendorId = Auth::guard('vendor')->id();
        $product = Product::with(['categories', 'images'])
            ->where('id', $id)
            ->where('created_by', $vendorId)
            ->firstOrFail();

        return view('vendor.products.individual', compact('product'));
    }

    public function indexforall($id)
    {
        $product = Product::with(['categories', 'vendor', 'images'])->where('status', 'active')->findOrFail($id);

        $topReviews = $product->reviews()
            ->with('user')
            ->orderByDesc('rating')
            ->orderByDesc('created_at')
            ->take(2)
            ->get();

        $userReview = null;
        if (auth()->check()) {
            $userReview = $product->reviews()
                ->where('user_id', auth()->id())
                ->with('user')
                ->first();
        }

        return view('products-index', compact('product', 'topReviews', 'userReview'));
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
            'main_title' => 'nullable|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'product_description' => 'nullable|string|max:65535',
            'app_file' => 'required|file', // 50MB |mimes:apk,ipa,zip
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'product_price' => 'required|numeric|min:0|max:99999999.99',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'version' => 'required|string|max:255',
            'size_in_mb' => 'nullable|numeric|min:0|max:999999.99',
            'platform' => 'required|in:android,ios,web',
            'type' => 'required|in:free,paid',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'update_patch' => 'nullable|string|max:65535',
        ]);

        // Generate unique product ID
        do {
            $productId = Str::random(15);
        } while (Product::where('id', $productId)->exists());

        $path = $request->file('app_file')->store('apps', 'public');

        $price = floatval($request->product_price);
        $discount = floatval($request->discount_percent ?? 0);
        $finalPrice = round($price - ($price * $discount / 100), 2);

        $product = Product::create([
            'id' => $productId,
            'product_name' => $request->product_name,
            'main_title' => $request->main_title,
            'short_title' => $request->short_title,
            'product_description' => $request->product_description,
            'product_price' => $price,
            'discount_percent' => $discount,
            'final_price' => $finalPrice,
            'version' => $request->version,
            'size_in_mb' => $request->size_in_mb,
            'platform' => $request->platform,
            'type' => $request->type,
            'release_date' => now(),
            'status' => 'pending',
            'created_by' => Auth::guard('vendor')->id(),
            'total_sold' => 0,
            'total_rating' => 0,
            'total_review' => 0,
            'average_rating' => 0,
            'last_updated' => now(),
            'update_patch' => $request->update_patch,
            'app_file' => $path,
        ]);

        // Attach categories
        $product->categories()->attach($request->categories);

        // Save main image
        if ($request->hasFile('main_image')) {
            $mainPath = $request->file('main_image')->store('products', 'public');
            $product->images()->create([
                'image_path' => $mainPath,
                'status' => 'main',
            ]);
        }

        // Save sub images
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $subPath = $subImage->store('products', 'public');
                $product->images()->create([
                    'image_path' => $subPath,
                    'status' => 'sub',
                ]);
            }
        }
        return redirect()->route('vendor.products.create')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['categories', 'reviews.user', 'images'])->findOrFail($id);

        $topReviews = $product->reviews()
            ->orderByDesc('rating')
            ->orderByDesc('created_at')
            ->take(2)
            ->with('user')
            ->get();

        $userReview = null;
        if (auth()->check()) {
            $userReview = $product->reviews()
                ->where('user_id', auth()->id())
                ->with('user')
                ->first();
        }

        return view('products-index', compact('product', 'topReviews', 'userReview'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if ($product->status !== 'active') {
            return redirect()->route('vendor.products.index')->with('error', 'Only active products can be edited.');
        }

        $categories = Category::all();

        // load categories relation to avoid N+1 problem in blade
        $product->load('categories');

        return view('vendor.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($product->status !== 'active') {
            return redirect()->route('vendor.products.index')->with('error', 'Only active products can be updated.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'main_title' => 'nullable|string|max:255',
            'short_title' => 'nullable|string|max:255',
            'product_description' => 'nullable|string|max:65535',
            'app_file' => 'nullable|file', // 50MB |mimes:apk,ipa,zip
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'product_price' => 'required|numeric|min:0|max:99999999.99',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'version' => 'required|string|max:255',
            'size_in_mb' => 'nullable|numeric|min:0|max:999999.99',
            'platform' => 'required|in:android,ios,web',
            'type' => 'required|in:free,paid',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'update_patch' => 'nullable|string|max:65535',
        ]);

        // Update main image if uploaded
        if ($request->hasFile('main_image')) {
            // Set all existing images to sub
            $product->images()->update(['status' => 'sub']);
            // Store new main image
            $mainPath = $request->file('main_image')->store('products', 'public');
            $product->images()->create([
                'image_path' => $mainPath,
                'status' => 'main',
            ]);
        }

        // Add new sub images
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $subPath = $subImage->store('products', 'public');
                $product->images()->create([
                    'image_path' => $subPath,
                    'status' => 'sub',
                ]);
            }
        }

         if ($request->hasFile('app_file')) {
            // Optionally, delete the old file
            if ($product->app_file && \Storage::disk('public')->exists($product->app_file)) {
                \Storage::disk('public')->delete($product->app_file);
            }
            $path = $request->file('app_file')->store('apps', 'public');
            $product->app_file = $path;
        }
        
        $price = floatval($request->product_price);
        $discount = floatval($request->discount_percent ?? 0);
        $finalPrice = round($price - ($price * $discount / 100), 2);

        $product->update([
            'product_name' => $request->product_name,
            'main_title' => $request->main_title,
            'short_title' => $request->short_title,
            'product_description' => $request->product_description,
            'product_price' => $price,
            'discount_percent' => $discount,
            'final_price' => $finalPrice,
            'version' => $request->version,
            'size_in_mb' => $request->size_in_mb,
            'platform' => $request->platform,
            'type' => $request->type,
            'update_patch' => $request->update_patch,
            'last_updated' => now(),
        ]);

        $product->categories()->sync($request->categories);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $vendorId = Auth::guard('vendor')->id();

        if ($product->created_by !== $vendorId) {
            return redirect()->route('vendor.products.index')->with('error', 'You do not have permission to delete this product.');
        }

        // Delete all product images from storage
        foreach ($product->images as $img) {
            if ($img->image_path && \Storage::disk('public')->exists($img->image_path)) {
                \Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $product->categories()->detach();
        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        if (\Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();
        return back()->with('success', 'Image deleted successfully.');
    }
}
