<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-10 px-4 max-w-4xl bg-white rounded shadow">
    <a href="{{ route('vendor.dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Vendor Dashboard
        </a>
    <h2 class="text-3xl font-bold mb-6">Edit Product</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
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

    <form action="{{ route('vendor.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $inputClass = "w-full border border-gray-300 rounded px-4 py-2";
            $labelClass = "block text-gray-700 font-semibold mb-1";
        @endphp

        <div>
            <label class="{{ $labelClass }}">Product Name:</label>
            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Main Title:</label>
            <input type="text" name="main_title" value="{{ old('main_title', $product->main_title) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Short Title:</label>
            <input type="text" name="short_title" value="{{ old('short_title', $product->short_title) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Description:</label>
            <textarea name="product_description" class="{{ $inputClass }}" rows="4">{{ old('product_description', $product->product_description) }}</textarea>
        </div>

        <!-- Main Image Section -->
        <div>
            <label class="{{ $labelClass }}">Main Image:</label>
            @php
                $mainImage = $product->images->where('status', 'main')->first();
            @endphp
            @if($mainImage)
                <div class="relative inline-block mb-3">
                    <img src="{{ asset('storage/' . $mainImage->image_path) }}" alt="Main Image" class="w-32 h-32 object-cover rounded border">
                </div>
            @endif
            <input type="file" name="main_image" accept="image/*" onchange="previewMainImage(event)" class="block">
            <div id="mainImagePreview" class="mt-2"></div>
        </div>

        <!-- Sub Images Section -->
        <div>
            <label class="{{ $labelClass }}">Existing Sub Images:</label>
            <div id="existingSubImages" class="flex flex-wrap gap-4 mb-3">
                @foreach ($product->images->where('status', 'sub') as $img)
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Sub Image" class="w-24 h-24 object-cover rounded border">
                    </div>
                @endforeach
            </div>
            <label class="{{ $labelClass }}">Add New Sub Images:</label>
            <input type="file" name="sub_images[]" accept="image/*" multiple onchange="previewSubImages(event)" class="block">
            <div id="subImagesPreview" class="flex flex-wrap gap-2 mt-2"></div>
        </div>

        <!-- Other Fields -->
        <div>
            <label class="{{ $labelClass }}">Price:</label>
            <input type="number" step="0.01" name="product_price" value="{{ old('product_price', $product->product_price) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Discount %:</label>
            <input type="number" step="0.01" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Final Price:</label>
            <input type="number" step="0.01" name="final_price" value="{{ old('final_price', $product->final_price) }}" class="{{ $inputClass }}" readonly>
        </div>

        <div>
            <label class="{{ $labelClass }}">Version:</label>
            <input type="text" name="version" value="{{ old('version', $product->version) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Size in MB:</label>
            <input type="number" step="0.01" name="size_in_mb" value="{{ old('size_in_mb', $product->size_in_mb) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Platform:</label>
            <select name="platform" class="{{ $inputClass }}">
                <option value="android" {{ old('platform', $product->platform) == 'android' ? 'selected' : '' }}>Android</option>
                <option value="ios" {{ old('platform', $product->platform) == 'ios' ? 'selected' : '' }}>iOS</option>
                <option value="web" {{ old('platform', $product->platform) == 'web' ? 'selected' : '' }}>Web</option>
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">Type:</label>
            <select name="type" class="{{ $inputClass }}">
                <option value="free" {{ old('type', $product->type) == 'free' ? 'selected' : '' }}>Free</option>
                <option value="paid" {{ old('type', $product->type) == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <div>
            <label for="categories" class="block font-medium text-gray-700 mb-1">Categories:</label>
            <select name="categories[]" id="categories" multiple class="w-full border border-gray-300 p-2 rounded mb-4">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">Release Date:</label>
            <input type="date" name="release_date" value="{{ old('release_date', $product->release_date) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">Status:</label>
            <select name="status" class="{{ $inputClass }}">
                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div>
            <label class="{{ $labelClass }}">Update Patch:</label>
            <input type="text" name="update_patch" value="{{ old('update_patch', $product->update_patch) }}" class="{{ $inputClass }}">
        </div>

        <div>
            <label class="{{ $labelClass }}">App File:</label>
            @if($product->app_file)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $product->app_file) }}" class="text-blue-600 underline" target="_blank">
                        Download Current App File
                    </a>
                </div>
            @endif
            <input type="file" name="app_file" class="block">
            <p class="text-sm text-gray-500 mt-1">Leave blank to keep the current file.</p>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Product</button>
        </div>
    </form>

    <!-- Delete sub images OUTSIDE the main form -->
    <div class="flex flex-wrap gap-4 mt-4">
        @foreach ($product->images->where('status', 'sub') as $img)
            <div class="relative inline-block">
                <img src="{{ asset('storage/' . $img->image_path) }}" alt="Sub Image" class="w-24 h-24 object-cover rounded border">
                <form action="{{ route('vendor.products.deleteImage', $img->id) }}" method="POST" class="absolute top-0 right-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white rounded-full px-2 py-1 text-xs opacity-80 hover:opacity-100" title="Delete">
                        &times;
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Preview newly selected main image
    function previewMainImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById("mainImagePreview");
            preview.innerHTML = "";
            const img = document.createElement("img");
            img.src = reader.result;
            img.className = "w-32 h-32 object-cover rounded border";
            preview.appendChild(img);
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Preview newly selected sub images
    function previewSubImages(event) {
        const files = event.target.files;
        const preview = document.getElementById("subImagesPreview");
        preview.innerHTML = "";
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.createElement("img");
                img.src = reader.result;
                img.className = "w-24 h-24 object-cover rounded border";
                preview.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    }
</script>
</body>
</html>
