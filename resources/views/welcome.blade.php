@extends('layout.home')

@section('content')
<div class="container mt-5 flex-grow-1">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-md-6 text-center text-md-start">
            <h1 class="display-4">Welcome to APP Store</h1>
            <p class="lead">Discover the best apps for your needs, all in one place.</p>
            <a href="#" class="btn btn-primary btn-lg">Explore Now</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="path/to/hero-illustration.png" alt="Hero Illustration" class="img-fluid">
        </div>
    </div>

    <!-- Best Selling Apps -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Best Selling Apps</h2>
        </div>
        @for($i = 0; $i < 4; $i++)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="path/to/app-image.png" class="card-img-top" alt="App Name">
                <div class="card-body">
                    <h5 class="card-title">App Name</h5>
                    <p class="card-text">Short description of the app goes here.</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Categorized Apps -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Browse by Category</h2>
        </div>
        @for($i = 0; $i < 3; $i++)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Category Name</h5>
                    <a href="#" class="btn btn-outline-primary">Explore</a>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Recommended Apps -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Recommended for You</h2>
        </div>
        @for($i = 0; $i < 4; $i++)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="path/to/app-image.png" class="card-img-top" alt="App Name">
                <div class="card-body">
                    <h5 class="card-title">App Name</h5>
                    <p class="card-text">Short description of the app goes here.</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection