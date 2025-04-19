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

    <style>
        body {
            background-color: #101014;
            color: #ffffff;
        }
        .offcanvas {
        backdrop-filter: blur(5px); 
    }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <img src="{{ asset('System_image/logo 2.png') }}" alt="Logo" width="30" height="50" class="d-inline-block align-text-top">
                <span class="font-weight-bold">APP Store</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="storeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Store
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="storeDropdown">
                            <li><a class="dropdown-item" href="#">Apps</a></li>
                            <li><a class="dropdown-item" href="#">Games</a></li>
                            <li><a class="dropdown-item" href="#">Categories</a></li>
                        </ul>
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
                        <a href="#" class="btn btn-outline-success">Download</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
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
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-lg-start mt-auto">
        <div class="text-center p-3">
            © 2023 APP Store. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle Script -->
    <script>
    // Detect system preference on first load
        window.addEventListener('DOMContentLoaded', () => {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const body = document.body;
            const navbar = document.querySelector('.navbar');
            const footer = document.querySelector('footer');
            const themeToggle = document.getElementById('themeToggle');
            const offcanvas = document.querySelector('.offcanvas');

            function applyTheme(isDark) {
                if (isDark) {
                    body.classList.add('dark-mode');
                    body.style.backgroundColor = '#101014';
                    body.style.color = '#ffffff';

                    navbar.classList.remove('bg-light');
                    navbar.classList.add('bg-dark');
                    navbar.classList.remove('navbar-light');
                    navbar.classList.add('navbar-dark');

                    footer.classList.remove('bg-light');
                    footer.classList.add('bg-dark');
                    footer.style.color = '#ffffff';

                    themeToggle.classList.remove('bi-brightness-high');
                    themeToggle.classList.add('bi-moon-stars-fill');
                    themeToggle.classList.remove('text-dark');
                    themeToggle.classList.add('text-warning');

                    offcanvas.style.backgroundColor = 'rgba(16, 16, 20, 0.5)';
                    offcanvas.style.color = '#ffffff';
                } else {
                    body.classList.remove('dark-mode');
                    body.style.backgroundColor = '#ffffff';
                    body.style.color = '#000000';

                    navbar.classList.remove('bg-dark');
                    navbar.classList.add('bg-light');
                    navbar.classList.remove('navbar-dark');
                    navbar.classList.add('navbar-light');

                    footer.classList.remove('bg-dark');
                    footer.classList.add('bg-light');
                    footer.style.color = '#000000';

                    themeToggle.classList.remove('bi-moon-stars-fill');
                    themeToggle.classList.add('bi-brightness-high');
                    themeToggle.classList.remove('text-warning');
                    themeToggle.classList.add('text-dark');

                    offcanvas.style.backgroundColor = 'rgba(255, 255, 255, 0.6)';
                    offcanvas.style.color = '#000000';
                }
            }

            applyTheme(prefersDark);

            themeToggle.addEventListener('click', () => {
                const isDark = body.classList.contains('dark-mode');
                applyTheme(!isDark);
            });
        });
    </script>

</body>
</html>
