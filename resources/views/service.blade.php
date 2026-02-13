@extends('layout.app')

@section('content')
<style>
    :root {
        --primary-green: #8cc63f;
        --soft-blue: #e3f2fd;
        --error-red: #ff6b6b;
    }

    /* HERO SECTION */
    .hero-section {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
        url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=2070');
        background-size: cover;
        background-position: center;
        max-width: 100%;
        min-height: 80vh; /* extended height */
        display: flex;
        align-items: center; /* vertical center */
        color: white;
    }
    

    .hero-section h1 {
        font-size: 2.8rem;
    }

    @media (min-width: 992px) {
        .hero-section h1 {
            font-size: 4rem;
        }
    }

    .btn-demo {
        background-color: var(--primary-green);
        border: none;
        color: white;
        font-weight: bold;
        padding: 12px 30px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-demo:hover {
        opacity: 0.9;
    }

    .btn-outline-white {
        border: 2px solid white;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-outline-white:hover {
        background: white;
        color: #333;
    }

    /* FEATURE CARDS */
    .feature-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .card-header-icon {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
    }

    .bg-fetch { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .bg-mail { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .bg-speed { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

    .read-more-btn {
        background-color: #f1f8ff;
        color: #007bff;
        border-radius: 20px;
        font-size: 0.85rem;
        padding: 6px 22px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        transition: 0.3s;
    }

    .read-more-btn:hover {
        background-color: #e0f0ff;
    }
    /* Section 2: Feature Card Styling */
    .feature-card {
        border: none;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: 0.3s;
    }

    .feature-card:hover { transform: translateY(-10px); }

    .card-top {
        height: 140px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        padding: 20px;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .bg-blue { background: linear-gradient(180deg, #e3f2fd 0%, #4facfe 100%); color: white; }
    .bg-red { background: linear-gradient(180deg, #ffebee 0%, #ff6b6b 100%); color: white; }
    .bg-teal { background: linear-gradient(180deg, #e0f2f1 0%, #38f9d7 100%); color: white; }

    .btn-read-more {
        background: #f8f9fa;
        color: #ef5350;
        border-radius: 20px;
        font-size: 0.8rem;
        padding: 5px 20px;
        border: 1px solid #eee;
    }
    .hero-section2 {
background: url('{{ asset('assets/images/banner-for-service.png') }}') center/cover no-repeat;

    min-height: 60vh; /* height of the section */
    display: flex;
    align-items: center; /* vertically center content */
    border-radius: 10px;
    margin-bottom: 30px;
}

        .services-container {
            margin-top: -150px; /* Pulls the cards up over the image */
        }

        .service-card {
            border: none;
            border-radius: 20px;
            padding: 40px 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background-color: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: -70px auto 20px; /* Positions icon half-out of the card */
            font-size: 24px;
        }

        .btn-more {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #000;
            color: #000;
            text-decoration: none;
            padding-bottom: 2px;
        }
</style>


<!-- HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                 <div class="">
                    <h1 class="main-heading">
                <span class="text-white">Data</span>.<span class="text-trending">Fetching</span>
                  <span class="text-white"> Automate </span><span class="text-news">Emailing</span>
                    </h1>
                </div>

                <div class="d-flex flex-wrap gap-3 mb-5 small">
                    <span>● Instant Quotes</span>
                    <span>● No Hidden Fees</span>
                    <span>● Reliable Speed</span>
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <button class="btn btn-demo">Contact US Now</button>
                    <button class="btn btn-demo">Learn More</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- second section -->
 <section class="container py-5">
  <div class="mb-5 text-center">
    <h1 class="main-heading">
      Our <span class="text-trending">Services</span>
    </h1>
  </div>    
    <div class="hero-section2 mx-2"></div>

    <div class="container services-container">
        <div class="row g-4 justify-content-center">
            
            <div class="col-md-4">
                <div class="card service-card text-center">
                    <div class="icon-box">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">Mobile Development</h5>
                        <p class="text-muted small">Sample text. Click to select the text box. Click again or double click to start editing the text. Excepteur sint occaecat cupidatat non proident.</p>
                        <a href="#" class="btn-more">MORE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card service-card text-center">
                    <div class="icon-box">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">Mobility Services</h5>
                        <p class="text-muted small">Sample text. Click to select the text box. Click again or double click to start editing the text. Excepteur sint occaecat cupidatat non proident.</p>
                        <a href="#" class="btn-more">MORE</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card service-card text-center">
                    <div class="icon-box">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">Software Consulting</h5>
                        <p class="text-muted small">Sample text. Click to select the text box. Click again or double click to start editing the text. Excepteur sint occaecat cupidatat non proident.</p>
                        <a href="#" class="btn-more">MORE</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- third seconton -->


<div class="container py-5 text-center">
  
  <div class="mb-5">
    <h1 class="main-heading">
      Check Out Our <span class="text-trending">Trending</span>
      Special <span class="text-news">Offers</span>
    </h1>
  </div>

  <div class="row g-4 justify-content-center">
    
    <div class="col-md-3">
      <div class="card h-100 shadow-sm p-4 offer-card">
        <div class="card-body d-flex flex-column">
          <div class="display-6 mb-2 text-muted"><i class="bi bi-unlock"></i></div>
          <h5 class="fw-bold text-uppercase small tracking-widest text-secondary">Free Plan</h5>
          <h2 class="price-tag">Free</h2>
          <p class="feature-text text-muted">Essential access to basic tools where you can <strong>fetch number data</strong> instantly.</p>
          <button class="btn btn-outline-dark w-100 rounded-pill mt-auto">Get Started</button>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card h-100 shadow-sm p-4 offer-card">
        <div class="card-body d-flex flex-column">
          <div class="display-6 mb-2 text-trending"><i class="bi bi-person-badge"></i></div>
          <h5 class="fw-bold text-uppercase small text-secondary">Pro Lead</h5>
          <h2 class="price-tag">$50</h2>
          <p class="feature-text text-muted">Advanced lookup capabilities to <strong>fetch email and phone numbers</strong> with ease.</p>
          <button class="btn btn-outline-primary w-100 rounded-pill mt-auto">Choose Pro</button>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card h-100 shadow-lg p-4 offer-card border-0" style="background: #ffffff;">
        <div class="card-body d-flex flex-column">
          <div class="display-6 mb-2 text-news"><i class="bi bi-envelope-paper-heart"></i></div>
          <h5 class="fw-bold text-uppercase small text-secondary">Business</h5>
          <h2 class="price-tag text-news">$100</h2>
          <p class="feature-text text-muted">Full communication suite to <strong>send unlimited emails</strong> from a single account.</p>
          <button class="btn btn-danger w-100 rounded-pill mt-auto" style="background-color: #ff4d4d; border: none;">Go Business</button>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card h-100 shadow-sm p-4 offer-card bg-dark text-white">
        <div class="card-body d-flex flex-column">
          <div class="display-6 mb-2 text-info"><i class="bi bi-cpu-fill"></i></div>
          <h5 class="fw-bold text-uppercase small text-info">Automation</h5>
          <h2 class="price-tag">$150</h2>
          <p class="feature-text text-light opacity-75">Scale up with <strong>auto-emails across multiple accounts</strong> with 1-minute intervals.</p>
          <button class="btn btn-info w-100 rounded-pill mt-auto">Unlock Elite</button>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- FEATURE SECTION -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Powerful Tool Features</h2>
        </div>






        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card feature-card text-center h-100">
                    <div class="card-top bg-blue">
                        <div class="icon-circle"><i class="bi bi-link-45deg"></i></div>
                        <h5 class="fw-bold mb-0">Error Data Fetching</h5>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">Automatically retrieves and resolves complex data errors in real-time speed.</p>
                        <a href="#" class="btn btn-read-more">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card text-center h-100">
                    <div class="card-top bg-red">
                        <div class="icon-circle"><i class="bi bi-envelope-at"></i></div>
                        <h5 class="fw-bold mb-0">Auto-Mail Sender</h5>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">Send automated, high-priority emails to clients with 99% delivery assurance.</p>
                        <a href="#" class="btn btn-read-more">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card feature-card text-center h-100">
                    <div class="card-top bg-teal">
                        <div class="icon-circle"><i class="bi bi-speedometer"></i></div>
                        <h5 class="fw-bold mb-0">Spam Score & Speed</h5>
                    </div>
                    <div class="card-body py-4">
                        <p class="text-muted mb-4">Analyze deliverability scores and optimize sending speed for peak performance.</p>
                        <a href="#" class="btn btn-read-more">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
