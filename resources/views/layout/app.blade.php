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
              

                <li class="scroll-to-section"><a href="{{ url('/about') }}">About Us</a></li>
              <li class="scroll-to-section"><a href="{{ url('/service') }}">Services</a></li>
              <li class="scroll-to-section"><a href="{{ url('/portfolio') }}">Portfolio</a></li>
              <li class="scroll-to-section"><a href="#blog">Blog</a></li> 
              <li class="scroll-to-section"><a href="{{route('contact')}}">Message Us</a></li> 
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
                        <li class="scroll-to-section"> <a href="{{ route('email-upload') }}"> Email</a></li>
                        <li class="scroll-to-section"><a href="{{ route('extract-data') }}"> Tools </a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Contact</h5>
                     <li><a href="#" class="text-white-50 text-decoration-none">123 Main Street, City, Country</a></li>
                        <li><a href="#" class="text-white-50 text-decoration-none">info@fmcsa.com</a></li>
                        <li > <a  class="text-white-50 text-decoration-none" href="#">+1 234 567 8900</a></li>
                       
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
