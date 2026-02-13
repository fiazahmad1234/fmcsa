@extends('layout.app')

@section('title', 'Truck Dispatching Services')

@section('content')

<!-- Hero Poster Section -->
<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6>Welcome to Space Dynamic</h6>
                <h2>We Make <em> Dispatching</em> &amp; <span>Easy</span> Reliable</h2>
                <p>Track & Go Dispatch is a professional truck dispatching platform designed to streamline logistics and fleet management <a rel="nofollow" href="https://templatemo.com/page/1" target="_parent">TemTrack & GoplateMo</a>.</p>
        
        @if(session('success1'))
                    <div class="alert alert-success">
                        {{ session('success1') }}
                    </div>
                @endif
                

                <!-- ✅ Validation Errors -->
                    
                <form method="POST" action="{{route('subscribe-home')}}">
                      @csrf

                  <fieldset>
                    <input type="email" name="email" class="email" placeholder="Enter your email to receive news" required>
                  </fieldset>
                  <fieldset>
                    <button type="submit" class="main-button">Subscribe</button>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                  <img src="assets/images/banner-right-image.png" alt="banner">
     </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<div class="container py-5 text-center">

  <div class="mb-5">
    <h1 class="main-heading">
      Check Out Our <span class="text-trending">Trending</span>
      Special <span class="text-news">Offers</span>
    </h1>
  </div>

  <div class="row g-4 justify-content-center">

    <!-- Free Plan -->
    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm p-4 offer-card">
        <div class="card-body d-flex flex-column align-items-center text-center">
          <div class="display-6 mb-2 text-muted"><i class="bi bi-unlock"></i></div>
          <h5 class="fw-bold text-uppercase small tracking-widest text-secondary">Free Plan</h5>
          <h2 class="price-tag">Free</h2>
          <p class="feature-text text-muted">
            Essential access to basic tools where you can <strong>fetch number data</strong> instantly.
          </p>
          <p class="fw-semibold mt-auto">Fetch: 2 Mails</p>
        </div>
      </div>
    </div>

    <!-- Pro Lead -->
    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm p-4 offer-card">
        <div class="card-body d-flex flex-column align-items-center text-center">
          <div class="display-6 mb-2 text-trending"><i class="bi bi-person-badge"></i></div>
          <h5 class="fw-bold text-uppercase small text-secondary">Pro Lead</h5>
          <h2 class="price-tag">$100</h2>
          <p class="feature-text text-muted">
            Advanced lookup capabilities to <strong>fetch email and phone numbers</strong> with ease.
          </p>
          <p class="fw-semibold mt-auto">Fetch: 500 Mails</p>
        </div>
      </div>
    </div>

    <!-- Business -->
    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 shadow-lg p-4 offer-card border-0" style="background: #ffffff;">
        <div class="card-body d-flex flex-column align-items-center text-center">
          <div class="display-6 mb-2 text-news"><i class="bi bi-envelope-paper-heart"></i></div>
          <h5 class="fw-bold text-uppercase small text-secondary">Business</h5>
          <h2 class="price-tag text-news">$150</h2>
          <p class="feature-text text-muted">
            Full communication suite to <strong>send unlimited emails</strong> from a single account.
          </p>
          <p class="fw-semibold mt-auto">Fetch: 100 Mails</p>
        </div>
      </div>
    </div>

    <!-- Automation / Gold -->
    <div class="col-12 col-md-6 col-lg-3">
      <div class="card h-100 shadow-sm p-4 offer-card bg-dark text-white">
        <div class="card-body d-flex flex-column align-items-center text-center">
          <div class="display-6 mb-2 text-info"><i class="bi bi-cpu-fill"></i></div>
          <h5 class="fw-bold text-uppercase small text-info">Automation</h5>
          <h2 class="price-tag">$150</h2>
          <p class="feature-text text-light opacity-75">
            Scale up with <strong>auto-emails across multiple accounts</strong> with 1-minute intervals.
          </p>
          <p class="fw-semibold mt-auto text-danger">Unlimited & Auto-mails</p>
        </div>
      </div>
    </div>

  </div>
</div>




  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="assets/images/about-left-image.png" alt="person graphic">
          </div>
        </div>
        <div class="col-lg-8 align-self-center">
          <div class="services">
            <div class="row">
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="icon">
                    <img src="assets/images/service-icon-01.png" alt="reporting">
                  </div>
                  <div class="right-text">
                    <h4>Dispatch Reporting</h4>
                    <p>We provide reliable dispatch reports to track loads performance easily</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                  <div class="icon">
                    <img src="assets/images/service-icon-02.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Load Management</h4>
                    <p>We manage your loads efficiently to ensure booking and on-time deliveries.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                  <div class="icon">
                    <img src="assets/images/service-icon-03.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Fleet Tracking</h4>
                    <p>We help monitor your trucks in real time for better control and transparency</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                  <div class="icon">
                    <img src="assets/images/service-icon-04.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Dispatch Support</h4>
                    <p>We offer easy-to-use dispatch solutions that save time and simplify operations.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="assets/images/services-left-image.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Grow your business with our <em>website</em> service &amp; <span>Project</span> Ideas</h2>
            <p>Our platform helps you collect, organize, and manage trucker contact details easily. You can access verified email addresses and phone numbers, store them securely, and use them for smooth communication and outreach with trusted industry accuracy.</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="first-bar progress-skill-bar">
                <h4>Email Deliverability</h4>
                <span>85%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="second-bar progress-skill-bar">
                <h4>Data Fetching</h4>
                <span>88%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="third-bar progress-skill-bar">
                <h4>Error Detection</h4>
                <span>90%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="portfolio" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2>See What Our Agency <em>Offers</em> &amp; What We <span>Provide</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                 <h4>Data Fetching</h4>
                  <p>Our tool collects all carrier information quickly and reliably.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/portfolio-image.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
              <div class="hidden-content">
                <h4>Email Sending</h4>
                  <p>Send emails to carriers efficiently with automated and verified tools.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/portfolio-image.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="hidden-content">
                <h4>Data Analysis</h4>
                 <p>Analyze carrier data for better planning, reporting, and decision-making.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/portfolio-image.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
              <div class="hidden-content">
                 <h4>Fast Operations</h4>
                 <p>Streamline your workflow and speed up all dispatch and communication tasks.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/portfolio-image.png" alt="">
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div id="blog" class="our-blog section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Check Out What Is <em>Trending</em> In Our Latest <span>News</span></h2>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="top-dec">
            <img src="assets/images/blog-dec.png" alt="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="left-image">
            <a href="#"><img src="assets/images/big-blog-thumb.jpg" alt="Workspace Desktop"></a>
            <div class="info">
              <div class="inner-content">
                <ul>
                  <li><i class="fa fa-calendar"></i> 24 January 2026</li>
                  <li><i class="fa fa-users"></i> Track & Go</li>
                  <li><i class="fa fa-folder"></i> Branding</li>
                </ul>
                <a href="#"><h4>Data Fetching &amp; Email Sending Auto</h4></a>
                <p>Our platform helps you fetch carrier data, send emails automatically, detect spam, secure all information, and manage ...</p>
                <div class="main-blue-button">
                  <a href="#">Discover More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="right-list">
            <ul>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 18 January 2026</span>
                  <a href="#"><h4>Data  &amp; Fetching</h4></a>
                  <p>Collect carrier information quickly and efficiently for smooth operations...</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/blog-thumb-01.jpg" alt=""></a>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 14 January 2024</span>
                  <a href="#"><h4>Email &amp;Sending</h4></a>
                  <p>Send emails to truckers automatically with verified contacts...</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/blog-thumb-01.jpg" alt=""></a>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-calendar"></i> 06 January 2026</span>
                  <a href="#"><h4>Spam &amp; Detection</h4></a>
                  <p>Detect spam and ensure your emails reach the right inbox....</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/blog-thumb-01.jpg" alt=""></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Feel Free To Send Us a Message About Your Needs</h2>
            <p>Get in touch with our team, send your message anytime, and we will respond quickly to assist you with all inquiries.</p>
            <div class="phone-info">
              <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">010-020-0340</a></span></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
     

          <form id="contact" action="{{route('contact.store')}}" method="post">
                @csrf

            <div class="row">
                   @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        
    </div>
@endif
              <div class="col-lg-6">
                    
                <fieldset>
                  <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="number" id="surname" placeholder="Number">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button ">Send Message</button>
                </fieldset>
              </div>
            </div>
            <div class="contact-dec">
              <img src="assets/images/contact-decoration.png" alt="">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection
