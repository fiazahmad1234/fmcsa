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

<div class="p-2" style="width:100%; background:#03a4ed; color:#fff; overflow:hidden; position:relative; z-index:9999; font-weight:600; font-family:Arial, sans-serif;">
   <div class="scrolling-banner">
        <span>Email Fetching • Auto Mail • Smart Configuration • Dashboard Analytics • Secure System • </span>
        <span>Email Fetching • Auto Mail • Smart Configuration • Dashboard Analytics • Secure System • </span>
        <span>Email Fetching • Auto Mail • Smart Configuration • Dashboard Analytics • Secure System • </span>
        <span>Email Fetching • Auto Mail • Smart Configuration • Dashboard Analytics • Secure System • </span>
    </div>
</div>

<style>
.scrolling-banner {
    display: flex;
    width: fit-content;
    animation: scroll 20s linear infinite;
}

.scrolling-banner span {
    white-space: nowrap;
    padding-right: 50px; /* spacing between repeated text */
}

.scrolling-banner:hover {
    animation-play-state: paused; /* pause on hover */
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}
</style>


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
<header class="header-area header-sticky wow slideInDown position-sticky top-0" 
        data-wow-duration="0.75s" data-wow-delay="0s" style="z-index: 9999;">    
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="/" class="logo">
              <h4>Track<span>&Go</span></h4>
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
                        <a href="{{ route('dashboard') }}" class="text-danger" style="position: relative;">dashboard
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
          @if(request()->is('/'))
    @include('popup')
@endif


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
                    <a href="#" class="text-white-50 fs-5 custome-last2-footer"><i class="bi bi-facebook text-white"></i></a>
                    <a href="#" class="text-white-50 fs-5 custome-last2-footer"><i class="bi bi-twitter-x text-white"></i></a>
                    <a href="#" class="text-white-50 fs-5 custome-last2-footer"><i class="bi bi-linkedin text-white" ></i></a>
                    <a href="#" class="text-white-50 fs-5 custome-last2-footer"><i class="bi bi-envelope text-white"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6">
            <div class="section-heading">
            <h2> <span class="text-danger">Quick <em>Links</em></h2></div> <hr class="about-line" stlye="color:red">
                            <ul class="list-unstyled small text-white">
               <li><i class="bi bi-chevron-right t custome-footer me-2"></i><a class="footer-link text-white" href="/">Home</a></li>
    <li><i class="bi bi-chevron-right text-light  custome-footer me-2" ></i><a class="footer-link text-white" href="{{ url('/service') }}">Services</a></li>
    <li><i class="bi bi-chevron-right   custome-footer me-2"></i><a class="footer-link text-white" href="{{ url('/portfolio') }}">Portfolio</a></li>
    <li><i class="bi bi-chevron-right  custome-footer me-2"></i><a class="footer-link text-white" href="{{ url('/about') }}">About Us</a></li>
    <li><i class="bi bi-chevron-right  custome-footer me-2"></i><a class="footer-link text-white" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6">
             <div class="section-heading">
            <h2> <span class="text-danger">Contact <em>Us</em></h2></div> <hr class="about-line" stlye="color:red">
                            <ul class="list-unstyled small text-white-50">
                    <li class="mb-2 text-white">
                        <i class="bi bi-geo-alt me-2 text-white custome-last-footer"></i>
                        25-11 41st Ave, Queens, NY 11101
                    </li>
                    <li class="mb-2 text-white">
                        <i class="bi bi-envelope me-2 text-white custome-last-footer"></i>
                        johnsmith13072@gmail.com
                    </li>
                    <li class="text-white">
                        <i class="bi bi-telephone me-2 text-white custome-last-footer"></i>
                        (0306)-649-8742 / (888)-649-8772
                    </li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small text-white-50">
            &copy; {{ date('Y') }} <strong>Track & Go</strong>. All Rights Reserved.
        </div>
    </div>
</footer>

<a href="https://wa.me/923067098742" target="_blank" style="
    position: fixed;
    bottom: 70px;
    right: 20px;
    z-index: 999;
    width: 60px;
    height: 60px;
    background-color: #25D366;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 28px;
    text-decoration: none;
">
    <i class="fab fa-whatsapp"></i>
</a>

 <script>
  document.addEventListener("DOMContentLoaded", function() {
    const menuTrigger = document.querySelector('.menu-trigger');
    const nav = document.querySelector('.nav');

    if (menuTrigger) {
      menuTrigger.addEventListener('click', function() {
        // Toggle the 'active' class on both the trigger (for animation) and the nav (for visibility)
        this.classList.toggle('active');
        nav.classList.toggle('active');
      });
    }
  });
</script> 
<!-- respnosvie -->

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
