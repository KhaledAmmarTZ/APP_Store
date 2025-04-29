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
            <a href="#" class="btn btn-link text-decoration-none me-3">Browse</a>
            <a href="#" class="btn btn-link text-decoration-none">Discover</a>
        </div>
    </div>
</div>

<!-- Main Carousel and Thumbnails -->
<div class="container-sm mt-5" style="height: 650px; overflow: hidden;">
    <div class="row">
        <div class="col-10">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 650px; overflow: hidden; border-radius: 10px;">
                <div class="carousel-inner" id="carouselItems" style="height: 100%;">
                    <!-- carousel items here -->
                </div>
            </div>
        </div>
        <div class="col-2">
            <div id="thumbnailCards" style="display: flex; flex-direction: column; height: 100%;"></div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('searchModal');
    const modal = new bootstrap.Modal(modalElement);
    const modalInput = document.getElementById('modalSearchInput');
    const mainInput = document.querySelector('form.d-sm-flex input[name="query"]');

    modalInput.addEventListener('input', () => mainInput.value = modalInput.value);
    mainInput.addEventListener('input', () => modalInput.value = mainInput.value);
    window.addEventListener('resize', function () {
        const isSmallScreen = window.innerWidth < 576;
        if (!isSmallScreen && modalElement.classList.contains('show')) {
            modal.hide();
            if (modalInput.value.trim() !== '') {
                mainInput.value = modalInput.value.trim();
            }
        }
    });
    const modalForm = document.getElementById('modalSearchForm');
    modalForm.addEventListener('submit', function () {
        modal.hide();
    });
});
</script>
@endsection
