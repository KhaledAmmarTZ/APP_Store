@extends('layout.home')

@section('content')
<div class="container py-5">
    <!-- Title Section -->
    <div class="text-right mb-5">
        <h2 class="mb-3">{{ $product->product_name }}</h2>

        <div class="mb-2 d-inline-flex align-items-center">
            <span class="star-rating-static ms-2">
                @php
                    $rating = $product->average_rating;
                    $fullStars = floor($rating);
                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                @endphp

                {{-- Full stars --}}
                @for ($i = 0; $i < $fullStars; $i++)
                    <label class="full">&#9733;</label>
                @endfor

                {{-- Half star --}}
                @if ($hasHalfStar)
                    <label class="half">
                        &#9733;
                        <span class="half-star">&#9733;</span>
                    </label>
                @endif

                {{-- Empty stars --}}
                @for ($i = 0; $i < $emptyStars; $i++)
                    <label>&#9733;</label>
                @endfor
            </span>
            <!-- <strong>Average Rating:</strong> -->
            <span class="ms-1">{{ $product->average_rating }}</span>
        </div>

        <p class="text-muted fs-5 mt-3">Discover more about this product below.</p>
    </div>

    <!-- Product Details Section -->
    <div class="row align-items-right">
        <!-- Product Image -->
        <div class="col-md-8 text-right mb-4">
            <img src="{{ asset('storage/' . $product->product_image) }}" 
                alt="{{ $product->product_name }}" 
                class="img-fluid w-100 rounded shadow-sm" 
                style="max-height: 500px;">

                <h5 class="mt-4">{{ $product->product_description }}</h1>

                <div class="mb-3">
                    <h5>Categories</h5>
                    @forelse($product->categories as $category)
                        <span class="badge bg-secondary me-1">{{ $category->category_name }}</span>
                    @empty
                        <span class="text-muted">No categories assigned</span>
                    @endforelse
                </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-4">


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

    {{-- Top 2 Most Rated Reviews --}}
    <div class="mt-5">
        <h4>Top Reviews</h4>
        @forelse($topReviews as $review)
            <div class="border rounded p-3 mb-3">
                <div>
                    <strong>{{ $review->user->name ?? 'Unknown User' }}</strong>
                    <span class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}">&#9733;</span>
                        @endfor
                    </span>
                    <small class="text-muted">{{ $review->updated_at->diffForHumans() }}</small>
                </div>
                <div>{{ $review->comment }}</div>
            </div>
        @empty
            <div class="text-muted">No reviews yet.</div>
        @endforelse
    </div>

    {{-- User's Own Review --}}
    @auth
        <div class="mt-5">
            <h4>Your Review</h4>
            @if($userReview)
                <div class="border rounded p-3 mb-3">
                    <div>
                        <span class="text-warning">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $userReview->rating ? 'text-warning' : 'text-secondary' }}">&#9733;</span>
                            @endfor
                        </span>
                        <small class="text-muted">{{ $userReview->updated_at->diffForHumans() }}</small>
                    </div>
                    <div>{{ $userReview->comment }}</div>
                </div>
            @else
                <div class="text-muted">You have not reviewed this product yet.</div>
            @endif
        </div>
    @endauth
</div>
@endsection
