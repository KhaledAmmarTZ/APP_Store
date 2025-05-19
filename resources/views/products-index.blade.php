@extends('layout.home')

@section('content')
<div class="container py-5">
    <!-- Title Section -->
    <div class="text-center mb-5">
        <h2 class="mb-3">{{ $product->product_name }}</h2>
        <p class="text-muted fs-5">Discover more about this product below.</p>
    </div>

    <!-- Product Details Section -->
    <div class="row align-items-start">
        <!-- Product Image -->
        <div class="col-md-5 text-center mb-4">
            <img src="{{ asset('storage/' . $product->product_image) }}" 
                alt="{{ $product->product_name }}" 
                class="img-fluid rounded shadow-sm" style="max-height: 400px;">
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item"><strong>Product ID:</strong> {{ $product->id }}</li>
                <li class="list-group-item"><strong>Price:</strong> ${{ $product->product_price }}</li>
                <li class="list-group-item"><strong>Discount:</strong> <span class="text-success">{{ $product->discount_percent }}%</span></li>
                <li class="list-group-item"><strong>Final Price:</strong> <span class="text-primary fw-bold">${{ $product->final_price }}</span></li>
                <li class="list-group-item"><strong>Version:</strong> {{ $product->version }}</li>
                
                @php
                    $sizeInMB = $product->size_in_mb;
                    $sizeFormatted = $sizeInMB >= 1024
                        ? number_format($sizeInMB / 1024, 2) . ' GB'
                        : number_format($sizeInMB, 2) . ' MB';
                @endphp
                <li class="list-group-item"><strong>Size:</strong> {{ $sizeFormatted }}</li>

                <li class="list-group-item"><strong>Developer:</strong> {{ $product->vendor->company_name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Platform:</strong> {{ ucfirst($product->platform) }}</li>
                <li class="list-group-item"><strong>Type:</strong> {{ ucfirst($product->type) }}</li>
                <li class="list-group-item"><strong>Total Sold:</strong> {{ $product->total_sold }}</li>
                <li class="list-group-item"><strong>Total Rating:</strong> {{ $product->total_rating }}</li>
                <li class="list-group-item"><strong>Total Reviews:</strong> {{ $product->total_review }}</li>
                <li class="list-group-item"><strong>Average Rating:</strong> {{ $product->average_rating }}</li>
            </ul>

            <!-- Description -->
            <div class="mb-3">
                <h5>Description</h5>
                <p class="text-muted">{{ $product->product_description }}</p>
            </div>

            <!-- Categories -->
            <div class="mb-3">
                <h5>Categories</h5>
                @forelse($product->categories as $category)
                    <span class="badge bg-secondary me-1">{{ $category->category_name }}</span>
                @empty
                    <span class="text-muted">No categories assigned</span>
                @endforelse
            </div>

            <!-- Dates -->
            <p class="text-muted"><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($product->release_date)->format('M d, Y') }}</p>
            <p class="text-muted"><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($product->last_updated)->diffForHumans() }}</p>
            <p class="text-muted"><strong>Update Patch:</strong> {{ $product->update_patch ?? 'None' }}</p>
        </div>
    </div>

    <!-- Disclaimer Section -->
    <div class="alert alert-info mt-5">
        <h5 class="alert-heading">Note</h5>
        <p class="mb-0">All product information is provided and managed by the vendor. Please verify details before making any purchasing decision.</p>
    </div>
</div>
@endsection
