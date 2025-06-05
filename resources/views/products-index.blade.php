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
            <div id="productImagesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($product->images as $key => $image)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->product_name }}"
                                class="img-fluid w-100 rounded shadow-sm"
                                style="max-height: 500px;">
                        </div>
                    @endforeach
                </div>
                    @if($product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>

                <h5 class="mt-4">{{ $product->main_title }}</h1>

                <div class="mb-3">
                    <h5>Categories</h5>
                    @forelse($product->categories as $category)
                        <span class="badge bg-secondary me-1">{{ $category->category_name }}</span>
                    @empty
                        <span class="text-muted">No categories assigned</span>
                    @endforelse
                </div>

                <h5 class="mt-4">{{ $product->short_title }}</h5>
                <h4 class="mt-4">{!! nl2br(e($product->product_description)) !!}</h4>

                <h5 class="mt-4">Follow Us</h5>
                <div class="d-flex">
                    <a href="#" class="btn btn-primary me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-info me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-danger me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-dark"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <h5 class="mt-4">KA Player Rating</h5>
                <div class="mb-2 d-inline-flex align-items-center" style="font-size: 6rem;"> {{-- Increased size --}}
                    <span class="star-rating-static ms-2" style="font-size: 6rem;"> {{-- Increased size --}}
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

                    <span class="ms-2">{{ $product->average_rating }}</span>
                </div>

                <h5 class="mt-4">{{ $product->product_name }} Rating and Reviews</h5>

                {{-- Top 3 Most Rated Reviews --}}
                <div class="mt-5">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($topReviews as $review)
                            <div class="col">
                                <div class="card h-100 border rounded shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <strong>{{ $review->user->name ?? 'Unknown User' }}</strong>
                                        </h5>
                                        <p class="card-text">
                                            
                                                <h4 class="mt-4 d-inline-block me-2">
                                                    {{ $review->rating }}/5
                                                </h4>
                                                <small class="text-muted d-inline-block">
                                                    {{ $review->updated_at->diffForHumans() }}
                                                </small>
                                        </p>
                                        <p class="card-text" style="text-size: 2rem">"{{ $review->comment }}"</p>
                                        <div class="card-footer">
                                            <h5> Read Full Review</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">No reviews yet.</div>
                        @endforelse
                    </div>
                </div>

                <h5 class="mt-4">{{ $product->product_name }} System Requirements</h5>
        </div>

        <!-- Product Info -->
        <div class="col-md-4">

            <ul class="list-unstyled mt-4">
                <li class="mb-2">
                    <a href="#" class="btn btn-primary w-100">Get</a>
                </li>
                <li class="mb-2">
                    <a href="#" class="btn btn-success w-100">Add to Cart</a>
                </li>
                <li>
                    <a href="#" class="btn btn-warning w-100">Add to Wishlist</a>
                </li>
            </ul>

            <p class="text"><strong>Developer:</strong> {{ $product->vendor->company_name }}</p>
            <!-- Dates -->

            <p class="text"><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($product->release_date)->format('M d, Y') }}</p>
            <p class="text"><strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($product->last_updated)->diffForHumans() }}</p>
            <p class="text"><strong>Update Patch:</strong> {{ $product->update_patch ?? 'None' }}</p>

            <p class="text"><strong>Platform:</strong> {{ $product->platform }}</p>

            <div class="d-flex gap-2 mt-3 w-100">
                <button type="button" class="btn btn-primary flex-grow-1">Share</button>
                <button type="button" class="btn btn-outline-danger flex-grow-1">Report</button>
            </div>
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

    <!-- Report Form Section -->
    <div class="mt-5">
        <h4>Report Product</h4>

        @auth
            <form action="{{ route('reports.store') }}" method="POST" class="border rounded p-4 shadow-sm mt-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason for Reporting:</label>
                    <textarea name="reason" id="reason" rows="3" class="form-control" placeholder="Optional: Describe the reason for reporting this product"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit Report</button>
            </form>
        @else
            <div class="alert alert-warning mt-3">
                Please <a href="{{ route('login') }}">login</a> to report a product.
            </div>
        @endauth

        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
        @endif
    </div>
</div>
@endsection
