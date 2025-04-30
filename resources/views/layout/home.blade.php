<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="clip-path: polygon(0 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 10px 100%, 0 calc(100% - 10px));">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center mx-auto" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <img src="{{ asset('System_image/logo 2.png') }}" alt="Logo" width="30" height="50" class="d-inline-block align-text-top me-2">
            <span class="font-weight-bold">APP Store</span>
        </a>

        <!-- Nav links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                <li class="nav-item me-3">
                    <i id="themeToggle" class="bi bi-moon-stars-fill fs-4 text-warning" style="cursor: pointer;" title="Toggle Theme"></i>
                </li>
                <li class="nav-item me-2">
                    <a href="#" class="btn btn-outline-primary">Sign In</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/download')}}" class="btn btn-outline-success">Download</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">APP Store</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <p>Welcome to the APP Store offcanvas menu. Here you can add additional content or navigation links.</p>
        <div class="d-grid gap-2">
            <a href="#" class="btn btn-primary">Home</a>
            <a href="#" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#storeMenu" aria-expanded="false" aria-controls="storeMenu">Store</a>
            <div class="collapse" id="storeMenu">
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-primary">Apps</a>
                    <a href="#" class="btn btn-outline-primary">Games</a>
                    <a href="#" class="btn btn-outline-primary">Categories</a>
                </div>
            </div>
        </div>
        <div class="mt-auto">
            <a href="#" class="btn btn-outline-primary w-100 mb-2">Sign In</a>
            <a href="#" class="btn btn-outline-success w-100">Download</a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content" style="margin-top: 56px;">
    @yield('content')
</div>

<hr style="hight:2px; color: transparent !important;"></hr>
<!-- Footer -->
<footer class="bg-dark text-center text-lg-start mt-auto" style="clip-path: polygon(10px 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 0 100%, 0 10px);">
    <div class="text-center p-3">
        © 2023 APP Store. All rights reserved.
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
