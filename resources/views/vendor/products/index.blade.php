<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-10 px-4 max-w-6xl bg-white rounded shadow">
    <h1 class="text-3xl font-bold mb-6">My Products</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <table class="min-w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Created At</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded" />
                    </td>
                    <td class="py-2 px-4">{{ $product->product_name }}</td>
                    <td class="py-2 px-4">${{ number_format($product->product_price, 2) }}</td>
                    <td class="py-2 px-4 capitalize">{{ $product->status }}</td>
                    <td class="py-2 px-4">{{ $product->created_at->format('Y-m-d') }}</td>
                    <td class="border p-2">
                        @if($product->status === 'active')
                            <a href="{{ route('vendor.products.edit', $product->id) }}"
                               class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Edit
                            </a>
                        @else
                            <span class="text-gray-500 italic">Edit disabled</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

</body>
</html>
