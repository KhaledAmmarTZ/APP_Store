<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vendor Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
    <style>
        body {
            background: #f8fafc;
        }
        .sidebar {
            min-height: 100vh;
            background: #212529;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #adb5bd;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            color: #fff;
            background: #0d6efd;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
        }
        .dashboard-card {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            background: #fff;
            padding: 2rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Vendor Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            Welcome, {{ Auth::guard('vendor')->user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Logout
                        </a>
                        <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar py-4">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}" href="{{ route('vendor.dashboard') }}">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->routeIs('vendor.products.index') ? 'active' : '' }}" href="{{ route('vendor.products.index') }}">
                                <i class="bi bi-box"></i> My Products
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link {{ request()->routeIs('vendor.products.create') ? 'active' : '' }}" href="{{ route('vendor.products.create') }}">
                                <i class="bi bi-plus-circle"></i> Add Product
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bar-chart"></i> Sales Reports
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                @yield('content')
            </main>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
