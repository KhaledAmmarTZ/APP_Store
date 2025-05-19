<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-2xl mt-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Product Image -->
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $product->product_image) }}" 
                     alt="{{ $product->product_name }}" 
                     class="rounded-lg w-full max-w-sm mx-auto lg:mx-0">
            </div>

            <!-- Product Details -->
            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->product_name }}</h1>
                <h1 class="text-xl text-gray-600">Product ID: {{ $product->id }}</h1>


                <div class="text-lg text-gray-700 space-y-2">
                    <p><strong>Price:</strong> <span class="text-gray-900">${{ $product->product_price }}</span></p>
                    <p><strong>Discount:</strong> <span class="text-green-600">{{ $product->discount_percent }}%</span></p>
                    <p><strong>Final Price:</strong> <span class="text-blue-600 font-semibold">${{ $product->final_price }}</span></p>
                    <p><strong>Version:</strong> {{ $product->version }}</p>
                    @php
                        $sizeInMB = $product->size_in_mb;
                        $sizeFormatted = $sizeInMB >= 1024
                            ? number_format($sizeInMB / 1024, 2) . ' GB'
                            : number_format($sizeInMB, 2) . ' MB';
                    @endphp

                    <p><strong>Size:</strong> {{ $sizeFormatted }}</p>

                    <p><strong>Developer:</strong> {{ $product->vendor->company_name }}</p>
                    <p><strong>Platform:</strong> {{ ucfirst($product->platform) }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($product->type) }}</p>
                    <p><strong>Description:</strong> {{ $product->product_description }}</p>

                    <p><strong>Categories:</strong>
                        @foreach($product->categories as $category)
                            <span class="inline-block bg-gray-200 text-gray-700 text-sm font-medium px-2 py-1 rounded-md mr-1">{{ $category->category_name }}</span>
                        @endforeach
                    </p>

                    <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($product->release_date)->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($product->last_updated)->diffForHumans() }}</p>
                    <p><strong>Update Patch:</strong> {{ $product->update_patch }}</p>
                    <p><strong>Platform:</strong> {{ ucfirst($product->platform) }}</p>
                    <p><strong>Total Sold:</strong> {{ $product->total_sold }}</p>
                    <p><strong>Total Rating:</strong> {{ $product->total_rating }}</p>
                    <p><strong>Total Reviews:</strong> {{ $product->total_review }}</p>
                    
                </div>
            </div>
        </div>
    </div>

</body>
</html>
