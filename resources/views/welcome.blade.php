@extends('layout.home')

@section('content')
<div class="container-sm mt-5 position-sticky" style="top: 90px; z-index: 1020;">
  <!-- Row for Search + Links -->
  <div class="row justify-content-start">
    <div class="col-4 d-flex align-items-center">
      <!-- Search Form -->
      <form class="d-flex me-3 flex-grow-1" method="GET" action="/search">
        <input class="form-control rounded-pill" type="search" placeholder="Search" aria-label="Search" name="query">
      </form>

      <!-- Links -->
      <a href="#" class="btn btn-link text-decoration-none me-3">Browse</a>
      <a href="#" class="btn btn-link text-decoration-none">Discover</a>
    </div>
  </div>
</div>


<div class="container-sm mt-5" style="height: 650px; overflow: hidden;">
    <div class="row">

        <div class="col-10">
            <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 650px; overflow: hidden; border-radius: 10px;">
                <div class="carousel-inner" id="carouselItems" style="height: 100%;"></div>
            </div>
        </div>

        <div class="col-2" style="position: relative; overflow: hidden;">
            <div id="thumbnailCards" style="display: flex; flex-direction: column; overflow: hidden;  position: relative; height: 100%;"></div>
        </div>

    </div>
</div>

<style id="dynamic-keyframes">
  /* The gray animation keyframes will be generated and inserted here */
</style>

@endsection
