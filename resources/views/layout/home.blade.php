<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
                <!-- this section is more manully change the dark mode icon to light mode icon and vice versa -->
                <li class="nav-item me-3">
                    <i id="themeToggle" class="bi bi-moon-stars-fill fs-4 text-warning" style="cursor: pointer;" title="Toggle Theme"></i>
                </li>
                <!-- this section is automatically change the dark mode icon to light mode icon and vice versa from the system -->
                <!-- <li class="nav-item me-3">
                    <i id="themeToggle" 
                    class="bi bi-moon-stars-fill fs-4 text-warning" 
                    style="visibility: hidden; pointer-events: none; user-select: none;" 
                    title="Toggle Theme"></i>
                </li>

                <script>
                    // Automatically follow system appearance for dark or light mode
                    const themeToggle = document.getElementById('themeToggle');

                    // Check system appearance and apply the appropriate theme
                    function applySystemTheme() {
                        const isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        if (isDarkMode) {
                            document.body.classList.add('dark-mode');
                            document.body.classList.remove('light-mode');
                        } else {
                            document.body.classList.add('light-mode');
                            document.body.classList.remove('dark-mode');
                        }
                    }

                    // Listen for system appearance changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applySystemTheme);

                    // Apply the theme on page load
                    applySystemTheme();
                </script> -->
                <li class="nav-item me-2">
                @if (Route::has('login'))
    <nav class="flex items-center justify-end gap-4">
        @auth('admin')
            <!-- Admin Dashboard Link -->
            <a
                href="{{ url('/admin/dashboard') }}"
                class="btn btn-dashboard"
            >
                Admin Dashboard
            </a>
        @elseauth('web')
            <!-- User Dashboard Link -->
            <a
                href="{{ url('/dashboard') }}"
                class="btn btn-dashboard"
            >
                User Dashboard
            </a>
        @else
            <!-- Login Link -->
            <a
                href="{{ route('login') }}"
                class="btn btn-login"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <!-- Register Link -->
                <a
                    href="{{ route('register') }}"
                    class="btn btn-register"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif
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
        @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="btn btn-dashboard"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="btn btn-login"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="btn btn-register"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content" style="margin-top: 56px;">
    @yield('content')
</div>

<hr style="hight:2px; color: transparent !important;"></hr>
<!-- Footer -->
<footer class="bg-dark   text-lg-start mt-auto theme-link" style="clip-path: polygon(10px 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 0 100%, 0 10px);">
  <div class="container py-5 position-relative theme-link">

    <!-- Top row with STORE and social icons -->
    <div class="d-flex justify-content-between align-items-center mb-4 theme-link">
      <h5 class="fw-bold theme-link">STORE</h5>
      <div class="d-flex gap-3 theme-link">
        <a href="#" class="  theme-link"><i class="fab fa-facebook-f theme-link"></i></a>
        <a href="#" class="  theme-link"><i class="fab fa-youtube theme-link"></i></a>
        <a href="#" class="  theme-link"><i class="fab fa-instagram theme-link"></i></a>
      </div>
    </div>

    <!-- Footer columns -->
    <div class="row theme-link">
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Games</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class=" text-decoration-none theme-link">Fortnite</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Fall Guys</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Rocket League</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Unreal Tournament</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Infinity Blade</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Shadow Complex</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Robo Recall</a></li>
        </ul>
      </div>
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Marketplaces</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class="  text-decoration-none theme-link">Epic Games Store</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Fab</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Sketchfab</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">ArtStation</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Store Refund Policy</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Store EULA</a></li>
        </ul>
      </div>
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Tools</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class="  text-decoration-none theme-link">Unreal Engine</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">UEFN</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">MetaHuman</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Twinmotion</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Megascans</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">RealityScan</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Rad Game Tools</a></li>
        </ul>
      </div>
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Online Services</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class="  text-decoration-none theme-link">Epic Online Services</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Kids Web Services</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Services Agreement</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Acceptable Use Policy</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Trust Statement</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Subprocessor List</a></li>
        </ul>
      </div>
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Company</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class="  text-decoration-none theme-link">About</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Newsroom</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Careers</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Students</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">UX Research</a></li>
        </ul>
      </div>
      <div class="col-md-2 theme-link">
        <h6 class="fw-bold mb-3 theme-link">Resources</h6>
        <ul class="list-unstyled theme-link">
          <li><a href="#" class="  text-decoration-none theme-link">Dev Community</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">MegaGrants</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Support-A-Creator</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Creator Agreement</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Distribute on Epic Games</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Unreal Engine Branding</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Fan Art Policy</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Community Rules</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">EU DSA Info</a></li>
          <li><a href="#" class="  text-decoration-none theme-link">Epic Pro Support</a></li>
        </ul>
      </div>
    </div>

    <!-- Divider -->
    <hr class="border-light my-4 theme-link">

    <!-- Bottom legal text and links -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center theme-link">
      <p class="mb-2 mb-md-0 small theme-link">
        © 2025, Epic Games, Inc. All rights reserved.
      </p>
      <div class="d-flex gap-3 flex-wrap theme-link">
        <a href="#" class="  text-decoration-none small theme-link">Terms of Service</a>
        <a href="#" class="  text-decoration-none small theme-link">Privacy Policy</a>
        <a href="#" class="  text-decoration-none small theme-link">Safety & Security</a>
        <a href="#" class="  text-decoration-none small theme-link">Store Refund Policy</a>
        <a href="#" class="  text-decoration-none small theme-link">Publisher Index</a>
      </div>
    </div>

    <!-- Back to top button -->
    <div class="text-end mt-3 theme-link">
        <button id="backToTopButton" class="btn btn-secondary btn-sm theme-link">Back to top</button>
    </div>
  </div>
</footer>




<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>