<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                    Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    Settings
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block mt-3">
                        Logout
                    </button>
                    </form>
                </li>
                </ul>
            </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Card Title 1</h5>
                    <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Card Title 2</h5>
                    <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Card Title 3</h5>
                    <p class="card-text">Some quick example text to build on the card title.</p>
                    </div>
                </div>
                </div>
            </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>