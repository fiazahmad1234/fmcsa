@extends('layout.app')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .portfolio-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
        background: #fff;
    }
    .portfolio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12) !important;
    }
    .feature-icon-box {
        height: 200px;
        overflow: hidden;
    }
    .feature-icon-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .portfolio-card:hover .feature-icon-box img {
        transform: scale(1.1);
    }
    .stats-card {
        background:red;
        color: white;
        border-radius: 20px;
        padding: 40px 20px;
    }
    .btn-gradient {
        background: var(--primary-gradient);
        color: white;
        border: none;
    }
    .btn-gradient:hover {
        color: white;
        filter: brightness(1.1);
    }
    .btn:hover{
        background-color:red;
        border:red;
    }
</style>

<div class="container mt-5 mb-5 py-">
    
    <div class="text-center mb-5 mt-3">
              <div class="mb-3">
                    <h1 class="main-heading"> Our <span class="text-trending">Tool</span>
                 </span><span class="text-news">Portfolio</span>
                    </h1>
                </div>        <p>
            The all-in-one solution for logistics automation. Connect with carriers, track every byte, and optimize your delivery funnel.
        </p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm portfolio-card">
                <div class="feature-icon-box">
                    <img src="https://images.unsplash.com/photo-1557200134-90327ee9fafa?auto=format&fit=crop&w=800&q=80" alt="Email Automation">
                </div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold">Automated Email Sending</h5>
                    <p class="text-muted small">Schedule and blast carrier notifications with 100% precision. Stop wasting hours on CCs and BCCs.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill px-4">View Tech Stack</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm portfolio-card">
                <div class="feature-icon-box">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Data Analytics">
                </div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold">Real-Time Data Fetching</h5>
                    <p class="text-muted small">Our API integration pulls carrier updates and error logs every 60 seconds into a single source of truth.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill px-4">View API Docs</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm portfolio-card">
                <div class="feature-icon-box">
                    <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80" alt="Deliverability">
                </div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold">Deliverability & Speed</h5>
                    <p class="text-muted small">High-speed SMTP relays ensuring your emails bypass spam folders and land directly in the inbox.</p>
                    <a href="#" class="btn btn-outline-primary rounded-pill px-4">Optimization Tips</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm portfolio-card">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80" class="card-img-top" style="height: 250px;" alt="Reporting">
                <div class="card-body p-4">
                    <h4 class="fw-bold">Advanced Reporting</h4>
                    <p class="text-muted">Export CSV, PDF, or JSON reports for your weekly performance meetings. Monitor carrier response times and success rates effortlessly.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm portfolio-card">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80" class="card-img-top" style="height: 250px;" alt="Reporting">
                <div class="card-body p-4">
                    <h4 class="fw-bold">User-Friendly Dashboard</h4>
                    <p class="text-muted">A clean, dark-mode ready interface designed for logistics managers. Minimal clicks, maximum productivity.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mb-5">
        <div class="col-12">
            <div class="stats-card shadow-lg">
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="display-5 text-black fw-bold">500k+</h2>
                        <p class="mb-0 text-black opacity-75">Processed Daily</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="display-5 text-black fw-bold">100+</h2>
                        <p class="mb-0 text-black opacity-75">Global Carriers</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="display-5 text-black fw-bold">99.9%</h2>
                        <p class="mb-0 text-black opacity-75">Uptime SLA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm rounded-4">
                <div class="text-warning mb-2">★★★★★</div>
                <p class="fst-italic text-muted small">"The automation engine is flawless. We reduced our coordination time by 40% in the first month."</p>
                <div class="d-flex align-items-center">
                    <div class="fw-bold">Ali R.</div>
                    <span class="ms-2 badge bg-light text-dark fw-normal">Logistics Lead</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm rounded-4">
                <div class="text-warning mb-2">★★★★★</div>
                <p class="fst-italic text-muted small">"Reliable SMTP and real-time error logging make this an essential tool for high-volume shipping."</p>
                <div class="d-flex align-items-center">
                    <div class="fw-bold">Sara K.</div>
                    <span class="ms-2 badge bg-light text-dark fw-normal">Ops Director</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm rounded-4">
                <div class="text-warning mb-2">★★★★★</div>
                <p class="fst-italic text-muted small">"Simple to integrate and the customer support is top-notch. Our carriers appreciate the clarity."</p>
                <div class="d-flex align-items-center">
                    <div class="fw-bold">Hamid T.</div>
                    <span class="ms-2 badge bg-light text-dark fw-normal">Coordinator</span>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center py-5 rounded-5 bg-light border">
        <h2 class="fw-bold mb-3">Ready to Automate Your Emails?</h2>
        <p class="text-muted mb-4">Join 200+ logistics companies revolutionizing their workflow.</p>
        <a href="#" class="btn btn-danger btn-lg rounded-pill px-5">Get Started Now</a>
    </div>
</div>
@endsection