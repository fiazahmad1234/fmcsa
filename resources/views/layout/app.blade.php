<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FMCSA App')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand fw-bold fs-4" href="#">Fiaz Ahamad</a>

      <!-- Hamburger button for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navigation links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
<a href="{{ route('email-upload') }}"
   class="nav-link {{ request()->routeIs('email-upload') ? 'active' : '' }}">
    Email
</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


    <!-- Main content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">FMCSA Analytics</h5>
                    <p class="small text-white-50">
                        Real-time FMCSA data & carrier analytics for your DOT/MC lookup needs.
                    </p>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Services</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">About Us</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Contact</h5>
                    <p class="small mb-1"><i class="bi bi-geo-alt-fill me-2"></i>123 Main Street, City, Country</p>
                    <p class="small mb-1"><i class="bi bi-envelope-fill me-2"></i>info@fmcsa.com</p>
                    <p class="small mb-0"><i class="bi bi-telephone-fill me-2"></i>+1 234 567 8900</p>
                </div>

            </div>
            <hr class="border-light">
            <div class="text-center small text-white-50">
                &copy; {{ date('Y') }} FMCSA Analytics. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
