<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vendor Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Vendor Dashboard</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
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
                        <a
                          class="nav-link"
                          href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                          Logout
                        </a>
                        <form
                          id="logout-form"
                          action="{{ route('vendor.logout') }}"
                          method="POST"
                          class="d-none"
                        >
                          @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Welcome to the Vendor Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-4">This is your vendor dashboard. Use the navigation bar to manage your account.</p>

                        <!-- Buttons for Product Routes -->
                        <div class="d-flex gap-3">
                            <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-primary">
                                Product Index
                            </a>
                            <a href="{{ route('vendor.products.create') }}" class="btn btn-outline-success">
                                Add New Product
                            </a>
                            <a href="{{ route('vendor.products.index') }}" class="btn btn-outline-warning">
                                Edit Product
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
