@extends('layout.home')

@section('content')
<div class="container py-5">
    <!-- Title Section -->
    <div class="text-right mb-5">
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
    <!-- Review Section -->
<div class="mt-5">
    <h4>Submit Your Review</h4>

    @auth
        <form action="{{ route('reviews.store') }}" method="POST" class="border rounded p-4 shadow-sm mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <style>
    .star-rating {
        direction: rtl;
        display: inline-flex;
        font-size: 1.8rem;
        cursor: pointer;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        color: #ccc;
        transition: color 0.2s;
    }
    .star-rating input[type="radio"]:checked ~ label {
        color: #ffc107;
    }
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>

<div class="mb-3">
    <label class="form-label">Rating:</label>
    <div class="star-rating">
        @for ($i = 5; $i >= 1; $i--)
            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
            <label for="star{{ $i }}">&#9733;</label> {{-- ★ --}}
        @endfor
    </div>
</div>


            <div class="mb-3">
                <label for="comment" class="form-label">Your Review:</label>
                <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Write something..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    @else
        <div class="alert alert-warning mt-3">
            Please <a href="{{ route('login') }}">login</a> to submit a review.
        </div>
    @endauth
</div>

</div>
@endsection
