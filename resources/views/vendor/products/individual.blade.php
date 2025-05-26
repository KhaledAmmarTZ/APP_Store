<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $product->product_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-10 px-4 max-w-3xl bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-6">{{ $product->product_name }}</h1>

    {{-- Main Image --}}
    <div class="mb-4">
        @php
            $mainImage = $product->images->where('status', 'main')->first();
        @endphp
        @if($mainImage)
            <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="Main Image" class="w-48 h-48 object-cover rounded border mb-2">
        @else
            <span class="text-gray-400 italic">No main image</span>
        @endif
    </div>

    {{-- All Images (Main + Sub) --}}
    <div class="mb-4">
        <strong>All Images:</strong>
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach($product->images as $img)
                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Product Image" class="w-20 h-20 object-cover rounded border">
            @endforeach
        </div>
    </div>

    <div class="mb-2"><strong>Price:</strong> ${{ number_format($product->product_price, 2) }}</div>
    <div class="mb-2"><strong>Status:</strong> {{ ucfirst($product->status) }}</div>
    <div class="mb-2">
        <strong>Created At:</strong>
        {{ $product->created_at ? $product->created_at->format('Y-m-d') : 'N/A' }}
    </div>
    <div class="mb-2"><strong>Description:</strong> {{ $product->product_description }}</div>
    <div class="mb-2"><strong>Categories:</strong>
        @foreach($product->categories as $cat)
            <span class="inline-block bg-gray-200 px-2 py-1 rounded mr-1">{{ $cat->category_name }}</span>
        @endforeach
    </div>
    <div class="mb-2"><strong>Version:</strong> {{ $product->version }}</div>
    <div class="mb-2"><strong>Platform:</strong> {{ ucfirst($product->platform) }}</div>
    <div class="mb-2"><strong>Type:</strong> {{ ucfirst($product->type) }}</div>
    <div class="mb-2">
        <strong>Release Date:</strong>
        {{ $product->release_date ? \Carbon\Carbon::parse($product->release_date)->format('Y-m-d') : 'N/A' }}
    </div>
    <div class="mb-2"><strong>Update Patch:</strong> {{ $product->update_patch }}</div>

    <a href="{{ route('vendor.products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Back to Products</a>
</div>
</body>
</html>