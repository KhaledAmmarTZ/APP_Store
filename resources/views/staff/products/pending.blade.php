<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pending Products Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Pending Products for Approval</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($pendingProducts->isEmpty())
            <p>No products pending approval.</p>
        @else
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 p-2 text-left">Product Name</th>
                        <th class="border border-gray-300 p-2 text-left">Description</th>
                        <th class="border border-gray-300 p-2 text-left">Price</th>
                        <th class="border border-gray-300 p-2 text-left">Image</th>
                        <th class="border border-gray-300 p-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingProducts as $product)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $product->product_name }}</td>
                            <td class="border border-gray-300 p-2">{{ $product->product_description }}</td>
                            <td class="border border-gray-300 p-2">${{ $product->product_price }}</td>
                            <td class="border border-gray-300 p-2">
                                <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" class="w-20 h-20 object-cover rounded" />
                            </td>
                            <td class="border border-gray-300 p-2 text-center space-x-2">
                                <form action="{{ route('staff.products.approve', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Approve</button>
                                </form>
                                <form action="{{ route('staff.products.reject', $product) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
