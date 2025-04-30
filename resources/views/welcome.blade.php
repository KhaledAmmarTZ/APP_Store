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
        <!-- Left Section: Text and Icon -->
        <div class="col">
            <span style="font-size: 1.5rem; font-weight: bold;">
                Discover new apps and games 
                <a href="/discover" class="text-decoration-none theme-link" style="font-size: 1.5rem;">
                    &gt;
                </a>
            </span>
        </div>

        <!-- Right Section: Navigation Buttons -->
        <div class="col-auto">
            <a href="#" class="btn btn-outline-secondary btn-sm me-2" title="Previous">
                &lt;
            </a>
            <a href="#" class="btn btn-outline-secondary btn-sm" title="Next">
                &gt;
            </a>
        </div>
    </div>

    <!-- Card Grid -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 mt-3">
    @php
        $titles = ['Clash of Clans', 'Call of Duty', 'PUBG Mobile', 'Among Us', 'Genshin Impact'];
        $price =['$0.99', '$1.99', '$2.99', '$3.99', '$4.99'];
    @endphp

    @for ($i = 0; $i < 5; $i++)
        <div class="col">
            <div class="card h-100 bg-transparent theme-link">
                <img src="{{ asset('System_image/game5.jpg') }}" class="card-img-top" alt="App Screenshot" style="border-radius: 10px; height: 260px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $titles[$i] }}</h5>
                    <p class="card-text " style="font-weight: bold;">{{ $price[$i] }}</p>
                </div>
                {{-- <div class="card-footer">
                    <small class="text-body-secondary">Last updated 3 mins ago</small>
                </div> --}}
            </div>
        </div>
    @endfor
    </div>
</div>

@endsection
