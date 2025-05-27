<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="icon" href="{{ asset('images/Trainlogo.png') }}" type="image/png"> -->
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
 
    <link href="https://fonts.googleapis.com/css2?family=Sansation&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansation:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
            body {
      overflow-x: hidden;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      padding-top: 1rem;
    }
    .sidebar .nav-link {
      color: #333;
    }
    .sidebar .nav-link.active {
      background-color: #007bff;
      color: #fff !important;
    }
    .sidebar .nav-link i {
      margin-right: 8px;
    }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/train (2).jpg') }}') no-repeat center center;
            background-size: cover;
            filter: blur(5px); /* Apply blur effect */
            z-index: -1; /* Keep it behind the content */
        }

        /* Dark overlay */
        .background-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Adjust the opacity (0.5 = 50% darker) */
            z-index: -1;
        }
    </style>

</head>
<body>
<div class="background-image"></div>
    <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light" style=" margin: 10px 17px; border-radius: 5px; background-color: #005F56; font-family: 'Sansation', sans-serif; font-weight: 700;">
                <a class="navbar-brand text-white" href="#">
                <img src="#" alt="Logo" style="height: 30px; width: auto; margin-right: 10px;">
                <span class="font-weight-bold">KA App Store</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Profile Section -->
                    <!-- <form class="form-inline my-2 my-lg-0 mx-3">
                        <img src="{{ auth()->guard('admin')->user()->admin_image ? asset('storage/' . auth()->guard('admin')->user()->admin_image) : asset('images/default-profile.png') }}" 
                            alt="Profile Picture" class="rounded-circle border" width="25" height="25">
                        <span class="ml-2 font-weight-bold text-white">{{ auth()->guard('admin')->user()->name }}</span>
                    </form> -->

                    <!-- Vertical Line -->
                    <!-- <div class="mx-2" style="border-left: 1px solid white; height: 25px;"></div> -->

                    <!-- Profile Icon (Thin) -->
                    <a href="{{ route('admin.profiles') }}" class="mx-2 d-flex align-items-center">
                        <i class="bi bi-person" style="color: white; font-size: 22px;"></i>
                    </a>

                    <!-- Settings Icon -->
                    <a href="{{ route('admin.profile.edit') }}" class="mx-2 d-flex align-items-center">
                        <i class="bi bi-gear" style="color: white; font-size: 22px;"></i> 
                    </a>

                    <form class="form-inline my-2 my-lg-0 ml-3" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block" style="background: none; border: none; padding: 0;">
                            <i class="fa-solid fa-arrow-right-from-bracket" style="color: white; font-size: 20px;"></i>
                        </button>
                    </form>
                </div>
            </nav>
        <div class="d-flex">
  <div class="sidebar d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-3 text-decoration-none">
      <i class="fab fa-bootstrap fa-lg mr-2"></i>
      <span class="font-weight-bold">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active">
          <i class="fas fa-home"></i> Home
        </a>
      </li>
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-table"></i> Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-box"></i> Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-users"></i> Customers
        </a>
      </li>
    </ul>
    <hr>
  </div>
                <!-- Main Content Section -->
                <div class="col p-3 main-content">
                        @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <script>
        function updateDateTime() {
            let now = new Date();
            let date = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            let time = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

            document.getElementById('datetime').innerHTML = `<span style="font-size: 22px;">${time}</span> <span style="font-size: 16px; margin-top: 5px;">${date}</span>`;
        }
        setInterval(updateDateTime, 1000); // Update every second
        updateDateTime(); // Initial call
    </script>
</body>
</html>