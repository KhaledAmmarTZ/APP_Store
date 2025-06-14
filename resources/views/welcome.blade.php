@extends('layout.home')

@section('content')

<!-- Sticky Top Search Bar -->
<div class="container-sm mt-5 position-sticky" style="top: 90px; z-index: 1020;">
    <div class="row justify-content-start">
        <div class="col-12 d-flex align-items-center">
            <!-- Search Icon for 500% zoom / small screens -->
            <div class="d-block d-sm-none me-3">
                <i 
                    class="bi bi-search fs-4" 
                    id="zoomSearchIcon" 
                    style="cursor: pointer;" 
                    data-bs-toggle="modal" 
                    data-bs-target="#searchModal"
                ></i>
            </div>

            <!-- Full Search Bar for larger screens -->
            <form class="d-none d-sm-flex me-3 flex-grow-1" method="GET" action="/search" style="max-width: 400px;">
                <input 
                    class="form-control rounded-pill shadow-sm px-4" 
                    type="search" 
                    placeholder="Search for apps, games, or categories..." 
                    name="query" 
                    style="border: 1px solid #ced4da; background-color: #f8f9fa;"
                >
            </form>

            <!-- Browse and Discover -->
            <a href="#" class="btn btn-link text-decoration-none me-3 theme-link">Browse</a>
            <a href="#" class="btn btn-link text-decoration-none theme-link">Discover</a>
        </div>
    </div>
</div>

<!-- Main Carousel and Thumbnails -->
<div class="container-sm mt-5" style="height: 720px; overflow: hidden;">
    <div class="row">
        <div class="col-10">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 720px; overflow: hidden; border-radius: 10px;">
                <div class="carousel-inner" id="carouselItems" style="height: 100%;">
                    <!-- carousel items here -->
                </div>
            </div>
        </div>
        <div class="col-2">
            <div id="thumbnailCards" style="display: flex; flex-direction: column; height: 100%; max-height: 720px;"></div>
        </div>
    </div>
</div>

<!-- Modal for Search on Small Screens -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Search input -->
                <form id="modalSearchForm" method="GET" action="/search">
                    <input 
                        type="search" 
                        class="form-control rounded-pill mb-4" 
                        placeholder="Search apps, games, or categories..." 
                        id="modalSearchInput"
                        name="query"
                    >
                </form>

                <!-- Search result carousel -->
                <div id="searchResultsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="text-center">
                                <h5>Result 1</h5>
                                <p>Description for result 1</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="text-center">
                                <h5>Result 2</h5>
                                <p>Description for result 2</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="text-center">
                                <h5>Result 3</h5>
                                <p>Description for result 3</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#searchResultsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#searchResultsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dynamic Keyframes Style -->
<style id="dynamic-keyframes">
  /* Gray animation keyframes can be inserted here */
</style>

<!-- Spacer -->
<div class="my-5"></div>

<!-- Section: Discover New Apps -->
<div class="container my-4">
    <div class="row align-items-center justify-content-between">
        <div class="col">
            <span style="font-size: 1.5rem; font-weight: bold;">
                Discover new apps and games 
                <a href="/discover" class="text-decoration-none theme-link" style="font-size: 1.5rem;">
                    &gt;
                </a>
            </span>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary btn-sm me-2" type="button" data-bs-target="#discoverCarousel" data-bs-slide="prev" title="Previous">
                &lt;
            </button>
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#discoverCarousel" data-bs-slide="next" title="Next">
                &gt;
            </button>
        </div>
    </div>

    <!-- discover new apps carousel -->
    <div id="discoverCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliderProducts->chunk(5) as $chunkIndex => $productChunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
                        @foreach($productChunk as $product)
                            @php
                                $mainImage = $product->images->first();
                                $discount = $product->product_price - $product->final_price;
                            @endphp
                            <div class="col">
                                <a href="{{ url('/products/' . $product->id) }}" class="text-decoration-none theme-link">
                                    <div class="card h-100 bg-transparent theme-link">
                                        @if($mainImage)
                                            <img src="{{ asset('storage/' . $mainImage->image_path) }}" class="card-img-top" alt="{{ $product->product_name }}" style="border-radius: 10px; height: 260px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="No Image" style="border-radius: 10px; height: 260px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->product_name }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="card-text text-muted" style="text-decoration: line-through;">
                                                    ৳{{ number_format($product->product_price, 2) }}
                                                </span>
                                                <span class="card-text fw-bold">
                                                    ৳{{ number_format($product->final_price, 2) }}
                                                </span>
                                            </div>
                                            <!-- <div class="text-danger" style="font-size:0.9rem;">
                                                Discount: ৳{{ number_format($discount, 2) }}
                                            </div> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Section: Featured discounts -->
<div class="container my-4">
    <div class="row align-items-center justify-content-between">
        <div class="col">
            <span style="font-size: 1.5rem; font-weight: bold;">
                Featured discounts 
                <a href="/discount" class="text-decoration-none theme-link" style="font-size: 1.5rem;">
                    &gt;
                </a>
            </span>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary btn-sm me-2" type="button" data-bs-target="#discountCarousel" data-bs-slide="prev" title="Previous">
                &lt;
            </button>
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#discountCarousel" data-bs-slide="next" title="Next">
                &gt;
            </button>
        </div>
    </div>

    <div id="discountCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($discountProducts->chunk(5) as $chunkIndex => $productChunk)
                <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
                        @foreach($productChunk as $product)
                            @php
                                $mainImage = $product->images->first();
                                $discount = $product->product_price - $product->final_price;
                            @endphp
                            <div class="col">
                                <a href="{{ url('/products/' . $product->id) }}" class="text-decoration-none theme-link">
                                    <div class="card h-100 bg-transparent theme-link shadow-sm" style="border-radius: 12px;">
                                        @if($mainImage)
                                            <img src="{{ asset('storage/' . $mainImage->image_path) }}"
                                                 class="card-img-top"
                                                 alt="{{ $product->product_name }}"
                                                 style="border-radius: 10px; height: 220px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default.jpg') }}"
                                                 class="card-img-top"
                                                 alt="No Image"
                                                 style="border-radius: 10px; height: 220px; object-fit: cover;">
                                        @endif
                                        <div class="card-body pb-2 pt-3 px-2">
                                            <h6 class="card-title mb-2" style="font-size: 1rem; font-weight: 600;">
                                                {{ $product->product_name }}
                                            </h6>
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="card-text text-muted" style="text-decoration: line-through; font-size: 0.95rem;">
                                                    ৳{{ number_format($product->product_price, 2) }}
                                                </span>
                                                <span class="card-text fw-bold" style="font-size: 1.05rem;">
                                                    ৳{{ number_format($product->final_price, 2) }}
                                                </span>
                                            </div>
                                            <!-- <div class="text-danger" style="font-size: 0.95rem;">
                                                Discount: ৳{{ number_format($discount, 2) }}
                                            </div> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        @php
            $titles = ['Clash of Clans', 'Call of Duty', 'PUBG Mobile', 'Among Us', 'Genshin Impact'];
            $price = ['$0.99', '$1.99', '$2.99', '$3.99', '$4.99'];
            $discount_price = ['$0.56', '$1.4', '$2.22', '$3.34', '$1.99'];
        @endphp
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4 mt-3">
        @for ($i = 0; $i < 3; $i++)
            <div class="col">
                <a href="/details/{{ $titles[$i] }}" class="text-decoration-none theme-link">
                    <div class="card h-100 bg-transparent theme-link">
                        <img src="{{ asset('System_image/game5.jpg') }}" class="card-img-top" alt="App Screenshot" style="border-radius: 10px; height: 260px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $titles[$i] }}</h5>
                            <div class="col d-12 d-flex justify-content-between align-items-center">
                                <p class="card-text text-muted" style="font-weight: bold; text-decoration: line-through">{{ $price[$i] }}</p>
                                <p class="card-text" style="font-weight: bold;">{{ $discount_price[$i] }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endfor
    </div>
</div>

<div class="container my-4">
  <div class="bg-dark text-white p-4 rounded-4">
    <!-- Header with Icon -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h5 class="mb-0">
        <i class="fas fa-gift me-2"></i> Free Games
      </h5>
      <button class="btn btn-outline-light btn-sm">View More</button>
    </div>

    <!-- Cards Row -->
    <div class="row g-3">
      @forelse($freeProducts as $product)
        @php
            $mainImage = $product->images->first();
        @endphp
        <div class="col-md-4">
            <a href="{{ url('/products/' . $product->id) }}" class="text-decoration-none theme-link">
            <div class="card bg-dark text-white border-0 h-100">
                @if($mainImage)
                <img src="{{ asset('storage/' . $mainImage->image_path) }}" class="card-img-top rounded-top" alt="{{ $product->product_name }}" style="height: 220px; object-fit: cover;">
                @else
                <img src="{{ asset('images/default.jpg') }}" class="card-img-top rounded-top" alt="No Image" style="height: 220px; object-fit: cover;">
                @endif
                <div class="bg-primary text-center py-1 fw-bold rounded-bottom">FREE NOW</div>
                <div class="card-body px-0">
                <h6 class="card-title mb-1">{{ $product->product_name }}</h6>
                <p class="card-text small">
                    {{ $product->description ? Str::limit($product->description, 40) : 'Free for a limited time!' }}
                </p>
                </div>
            </div>
            </a>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-info">No free games available right now.</div>
        </div>
      @endforelse

      <!-- Coming Soon Card -->
      <div class="col-md-4">
        <div class="card bg-dark text-white border-0 h-100">
          <img src="{{ asset('System_image/game5.jpg') }}" class="card-img-top rounded-top" alt="Super Space Club" style="height: 220px; object-fit: cover;">
          <div class="bg-black text-center py-1 fw-bold rounded-bottom">COMING SOON</div>
          <div class="card-body px-0">
            <h6 class="card-title mb-1">Super Space Club</h6>
            <p class="card-text small">Free May 01 – May 08</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-5 theme-link">
  <div class="row text-white theme-link">
    <!-- Top Sellers -->
    <div class="col-md-4 mb-4 theme-link">
      <h5 class="fw-bold mb-3">Top Sellers <span class="ms-1">&gt;</span></h5>
      <div class="d-flex flex-column gap-3">
        <!-- Card Item -->
        <div class="d-flex game-card p-2">
            <img src="{{ asset('System_image/game1.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="Clair Obscur">
            <div>
                <h6 class="mb-1 fw-semibold">Clair Obscur: Expedition 33</h6>
                <small>$34.99</small>
            </div>
        </div>


        <div class="d-flex game-card p-2">
          <img src="{{ asset('System_image/game2.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="Dead by Daylight">
          <div>
            <h6 class="mb-1 fw-semibold">Dead by Daylight</h6>
            <small>$9.99</small>
          </div>
        </div>

        <div class="d-flex game-card p-2">
          <img src="{{ asset('System_image/game3.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="GTA V">
          <div>
            <h6 class="mb-1 fw-semibold">Grand Theft Auto V Enhanced</h6>
            <small>$29.99</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Most Played -->

    <div class="col-md-4 mb-4 theme-link">
      <h5 class="fw-bold mb-3">Most Played <span class="ms-1">&gt;</span></h5>
      <div class="d-flex flex-column gap-3">
        <div class="d-flex game-card p-2">
          <img src="{{ asset('System_image/fortnite.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="Fortnite">
          <div>
            <h6 class="mb-1 fw-semibold">Fortnite</h6>
            <small>Free</small>
          </div>
        </div>

        <div class="d-flex game-card p-2">
          <img src="{{ asset('System_image/rocketleague.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="Rocket League">
          <div>
            <h6 class="mb-1 fw-semibold">Rocket League®</h6>
            <small>Free</small>
          </div>
        </div>

        <div class="d-flex game-card p-2">
          <img src="{{ asset('System_image/valorant.jpg') }}" class="rounded-3 me-3" width="80" height="100" alt="Valorant">
          <div>
            <h6 class="mb-1 fw-semibold">VALORANT</h6>
            <small>Free</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Top Upcoming Wishlisted -->
    <div class="col-md-4 mb-4 theme-link">
      <h5 class="fw-bold mb-3 theme-link">Top Upcoming Wishlisted <span class="ms-1">&gt;</span></h5>
      <div class="d-flex flex-column gap-3 theme-link">
        <div class="d-flex game-card p-2 theme-link">
          <img src="{{ asset('System_image/borderlands4.jpg') }}" class="rounded-3 me-3 theme-link" width="80" height="100" alt="Borderlands 4">
          <div>
            <h6 class="mb-1 fw-semibold theme-link">Borderlands 4</h6>
            <small>Available 09/12/25</small>
          </div>
        </div>

        <div class="d-flex game-card p-2 theme-link">
          <img src="{{ asset('System_image/lowlifeforms.jpg') }}" class="rounded-3 me-3 theme-link" width="80" height="100" alt="Lowlife Forms">
          <div>
            <h6 class="mb-1 fw-semibold theme-link">Lowlife Forms</h6>
            <small>Coming Soon</small>
          </div>
        </div>

        <div class="d-flex game-card p-2 theme-link">
          <img src="{{ asset('System_image/dyinglight.jpg') }}" class="rounded-3 me-3 theme-link" width="80" height="100" alt="Dying Light">
          <div>
            <h6 class="mb-1 fw-semibold theme-link">Dying Light: The Beast</h6>
            <small>Coming Soon</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
