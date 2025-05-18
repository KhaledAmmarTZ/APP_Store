<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10 px-4 max-w-4xl bg-white rounded shadow">
        <h2 class="text-3xl font-bold mb-6">Add New Product</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block font-medium mb-1" for="product_name">Product Name</label>
                <input
                    type="text"
                    name="product_name"
                    id="product_name"
                    value="{{ old('product_name') }}"
                    class="w-full border border-gray-300 p-2 rounded"
                    placeholder="Enter product name"
                    required
                />
            </div>

            <div>
                <label class="block font-medium mb-1" for="product_description">Description</label>
                <textarea
                    name="product_description"
                    id="product_description"
                    rows="4"
                    class="w-full border border-gray-300 p-2 rounded"
                    placeholder="Write product description..."
                >{{ old('product_description') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1" for="product_image">Product Image</label>
                <input
                    type="file"
                    name="product_image"
                    id="product_image"
                    accept="image/*"
                    class="w-full border border-gray-300 p-2 rounded"
                    required
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1" for="product_price">Price ($)</label>
                    <input
                        type="number"
                        step="0.01"
                        name="product_price"
                        id="product_price"
                        value="{{ old('product_price') }}"
                        class="w-full border border-gray-300 p-2 rounded"
                        required
                    />
                </div>

                <div>
                    <label class="block font-medium mb-1" for="discount_percent">Discount ($)</label>
                    <input
                        type="number"
                        step="0.01"
                        name="discount_percent"
                        id="discount_percent"
                        value="{{ old('discount_percent') }}"
                        class="w-full border border-gray-300 p-2 rounded"
                    />
                </div>


                <div>
                    <label class="block font-medium mb-1" for="version">Version</label>
                    <input
                        type="text"
                        name="version"
                        id="version"
                        value="{{ old('version') }}"
                        class="w-full border border-gray-300 p-2 rounded"
                        required
                    />
                </div>

                <div>
                    <label class="block font-medium mb-1" for="size_in_mb">Size (MB)</label>
                    <input
                        type="number"
                        step="0.01"
                        name="size_in_mb"
                        id="size_in_mb"
                        value="{{ old('size_in_mb') }}"
                        class="w-full border border-gray-300 p-2 rounded"
                    />
                </div>

                <div>
                    <label class="block font-medium mb-1" for="platform">Platform</label>
                    <select
                        name="platform"
                        id="platform"
                        class="w-full border border-gray-300 p-2 rounded"
                        required
                    >
                        <option value="" disabled {{ old('platform') ? '' : 'selected' }}>Select platform</option>
                        <option value="web" {{ old('platform') == 'web' ? 'selected' : '' }}>Web</option>
                        <option value="android" {{ old('platform') == 'android' ? 'selected' : '' }}>Android</option>
                        <option value="ios" {{ old('platform') == 'ios' ? 'selected' : '' }}>iOS</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-1" for="type">Type</label>
                    <select
                        name="type"
                        id="type"
                        class="w-full border border-gray-300 p-2 rounded"
                        required
                    >
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select type</option>
                        <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Free</option>
                        <option value="paid" {{ old('type') == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                
            </div>

            <div>
                <label for="categories" class="block font-medium mb-1">Categories</label>
                <select
                    name="categories[]"
                    id="categories"
                    class="w-full border border-gray-300 p-2 rounded"
                    multiple
                    required
                >
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @empty
                        <option disabled>No categories found</option>
                    @endforelse
                </select>
                <p class="text-sm text-gray-500 mt-1">Hold Ctrl (or Cmd) to select multiple categories</p>
            </div>

            <div>
                <label class="block font-medium mb-1" for="update_patch">Update Patch Notes</label>
                <textarea
                    name="update_patch"
                    id="update_patch"
                    rows="3"
                    class="w-full border border-gray-300 p-2 rounded"
                >{{ old('update_patch') }}</textarea>
            </div>

            <div class="text-right">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>

</body>
</html>
