<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FMCSA App')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
 <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">





    <!-- Custom CSS -->
         <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/templatemo-space-dynamic.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
   <!-- ***** Preloader Start ***** -->
  <!-- <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="/" class="logo">
              <h4>Fiaz<span>Ahmad</span></h4>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
                <li class="scroll-to-section"><a href="/">Home</a></li>
              <li class="scroll-to-section"><a href="{{ url('/service') }}">Services</a></li>
              <li class="scroll-to-section"><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                <li class="scroll-to-section"><a href="{{ url('/about') }}">About Us</a></li>

<li class="scroll-to-section">
    @auth
        <a href="#" class="text-danger" style="position: relative;">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="all: unset; cursor: pointer;">
                    Logout
                </button>
            </form>
        </a>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth
</li>
              <li class="scroll-to-section"><div class="main-red-button"><a href="{{route('contact')}}">Contact Now</a></div></li> 
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>

    <!-- Main content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
   <footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row gy-4">

            <!-- Brand -->
            <div class="col-lg-4 col-md-6">
             <div class="section-heading">
            <h2> <span class="text-danger">Track <em>&Go</em></h2></div> <hr class="about-line" stlye="color:red">
            

    <p class="text-white text-start">
                 Real-time FMCSA data with advanced DOT & MC carrier analytics that empower trucking
    companies, brokers, and logistics professionals to verify carriers.
                </p>


                <!-- Social Icons -->
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white-50 fs-5"><i class="bi bi-facebook text-white"></i></a>
                    <a href="#" class="text-white-50 fs-5"><i class="bi bi-twitter-x text-white"></i></a>
                    <a href="#" class="text-white-50 fs-5"><i class="bi bi-linkedin text-white" ></i></a>
                    <a href="#" class="text-white-50 fs-5"><i class="bi bi-envelope text-white"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6">
            <div class="section-heading">
            <h2> <span class="text-danger">Quick <em>Links</em></h2></div> <hr class="about-line" stlye="color:red">
                            <ul class="list-unstyled small text-white">
                    <li><a class="footer-link text-white" href="/">Home</a></li>
                    <li><a class="footer-link text-white" href="{{ url('/service') }}">Services</a></li>
                    <li><a class="footer-link text-white" href="{{ url('/portfolio') }}">Portfolio</a></li>
                    <li><a class="footer-link text-white" href="{{ url('/about') }}">About Us</a></li>
                    <li><a class="footer-link text-white" href="{{ route('contact') }}">Contact Us</a></li>

                    @auth
                        <li><a class="footer-link  text-danger" href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li><a class="footer-link text-white" href="{{ route('login') }}">Login</a></li>
                    @endauth 

                    <li><a class="footer-link" href="{{ route('email-upload') }}">Email Tool</a></li>
                    <li><a class="footer-link" href="{{ route('extract-data') }}">Analytics Tools</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
             <div class="section-heading">
            <h2> <span class="text-danger">Contact <em>Us</em></h2></div> <hr class="about-line" stlye="color:red">
                            <ul class="list-unstyled small text-white-50">
                    <li class="mb-2 text-white">
                        <i class="bi bi-geo-alt me-2 text-white"></i>
                        25-11 41st Ave, Queens, NY 11101
                    </li>
                    <li class="mb-2 text-white">
                        <i class="bi bi-envelope me-2 text-white"></i>
                        johnsmith13072@gmail.com
                    </li>
                    <li class="text-white">
                        <i class="bi bi-telephone me-2 text-white"></i>
                        (0306)-649-8742 / (888)-649-8772
                    </li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small text-white-50">
            &copy; {{ date('Y') }} <strong>FMCSA Analytics</strong>. All Rights Reserved.
        </div>
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
