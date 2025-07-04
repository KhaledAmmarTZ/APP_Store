@extends('layout.vendor')

@section('content')

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="fw-bold mb-0">Add New Product</h2>
        <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow-sm p-4">
        @csrf

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control" placeholder="Enter product name" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Platform</label>
                <select name="platform" class="form-select" x-model="platform" required>
                    <option value="" disabled>Select platform</option>
                    <option value="web" {{ old('platform') == 'web' ? 'selected' : '' }}>Web</option>
                    <option value="android" {{ old('platform') == 'android' ? 'selected' : '' }}>Android</option>
                    <option value="ios" {{ old('platform') == 'ios' ? 'selected' : '' }}>iOS</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Type</label>
                <select name="type" class="form-select" x-model="type" required>
                    <option value="" disabled>Select type</option>
                    <option value="free" {{ old('type') == 'free' ? 'selected' : '' }}>Free</option>
                    <option value="paid" {{ old('type') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Main Title</label>
                <input type="text" name="main_title" maxlength="100" x-model="mainTitle" class="form-control" placeholder="Main title (max 100 chars)">
                <div class="form-text text-end" x-text="mainTitle.length + '/100'"></div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Short Title</label>
                <input type="text" name="short_title" maxlength="60" x-model="shortTitle" class="form-control" placeholder="Short title (max 60 chars)">
                <div class="form-text text-end" x-text="shortTitle.length + '/60'"></div>
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="product_description" rows="3" maxlength="500" x-model="description" class="form-control" placeholder="Describe your product..."></textarea>
            <div class="form-text text-end" x-text="description.length + '/500'"></div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Version</label>
                <input type="text" name="version" value="{{ old('version') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Size (MB)</label>
                <input type="number" step="0.01" name="size_in_mb" value="{{ old('size_in_mb') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Price ($)</label>
                <input type="number" step="0.01" name="product_price" value="{{ old('product_price') }}" class="form-control" required>
            </div>
        </div>

        <div class="row g-4 mt-2" x-show="type === 'paid'">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Discount (%)</label>
                <input type="number" step="0.01" name="discount_percent" value="{{ old('discount_percent') }}" class="form-control">
            </div>
        </div>

        <div class="mt-4">
            <label class="form-label fw-semibold">Categories</label>
            <select name="categories[]" class="form-select" multiple required>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @empty
                    <option disabled>No categories found</option>
                @endforelse
            </select>
            <div class="form-text">Hold Ctrl (or Cmd) to select multiple categories</div>
        </div>

        <div class="mt-4">
            <label class="form-label fw-semibold">Update Patch Notes</label>
            <textarea name="update_patch" rows="2" maxlength="300" x-model="patchNotes" class="form-control" placeholder="What's new?"></textarea>
            <div class="form-text text-end" x-text="patchNotes.length + '/300'"></div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Main Product Image</label>
                <input type="file" name="main_image" accept="image/*" class="form-control" required @change="previewImage($event, 'main')">
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <template x-for="img in mainImagePreview" :key="img">
                        <img :src="img" class="rounded border" style="height: 80px; width: 80px; object-fit: cover;">
                    </template>
                </div>
                <div class="form-text">Select the main image for your product.</div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Sub Images (Gallery)</label>
                <input type="file" name="sub_images[]" multiple accept="image/*" class="form-control" @change="previewImage($event, 'sub')">
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <template x-for="img in subImagePreview" :key="img">
                        <img :src="img" class="rounded border" style="height: 80px; width: 80px; object-fit: cover;">
                    </template>
                </div>
                <div class="form-text">You can select multiple sub images (hold Ctrl/Cmd).</div>
            </div>
        </div>

        <div class="mt-4" x-show="showAppFile">
            <label class="form-label fw-semibold">App File (APK/IPA/ZIP/Any)</label>
            <input type="file" name="app_file" class="form-control" :required="showAppFile">
            <div class="form-text">Required for Android/iOS/Web platforms.</div>
        </div>

        <div class="mt-5 text-end">
            <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold">
                <i class="bi bi-upload me-2"></i>Submit Product
            </button>
        </div>
    </form>


<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function productForm() {
    return {
        platform: '{{ old('platform') }}',
        type: '{{ old('type') }}',
        mainTitle: '{{ old('main_title') ?? '' }}',
        shortTitle: '{{ old('short_title') ?? '' }}',
        description: '{{ old('product_description') ?? '' }}',
        patchNotes: '{{ old('update_patch') ?? '' }}',
        mainImagePreview: [],
        subImagePreview: [],
        get showAppFile() {
            return this.platform === 'android' || this.platform === 'ios' || this.platform === 'web';
        },
        previewImage(event, type) {
            const files = Array.from(event.target.files);
            const previews = [];
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        previews.push(e.target.result);
                        if (type === 'main') this.mainImagePreview = previews;
                        if (type === 'sub') this.subImagePreview = previews;
                    };
                    reader.readAsDataURL(file);
                }
            });
            if (type === 'main' && !files.length) this.mainImagePreview = [];
            if (type === 'sub' && !files.length) this.subImagePreview = [];
        }
    }
}
</script>
@endsection