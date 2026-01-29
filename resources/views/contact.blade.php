@extends('layout.app')

@section('title', 'Contact Us')

@section('content')

<!-- Bootstrap CSS (if not in layout already) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom minimal CSS -->
<style>
    .contact-banner {
        background: url('assets/images/contact-us.png') center/cover no-repeat;
        color: #fff;
        text-align: center;
        padding: 8rem 2rem;
        position: relative;
    }
    .contact-banner::after {
        content: '';
        position: absolute;
        top:0; left:0;
        width:100%; height:100%;
        background: rgba(0,0,0,0.5);
        z-index: 0;
    }
    .contact-banner h1, .contact-banner p {
        position: relative;
        z-index: 1;
    }
    .contact-section {
        margin-top: -4rem; /* pull up over banner */
    }
    .contact-banner p{
        padding-left:440px;
        padding-right:440px;
    }
 

 h2 {
  font-size: 50px;
  font-weight: 700;
  color: #f3f3f3;
  line-height: 72px;
}
.red-text{
    color:red;
}
</style>

<!-- Banner -->
<div class="contact-banner d-flex flex-column justify-content-center align-items-center" style="height: 600px;">
 <div class="section-heading">
            <h2> <span>Contact<span> <em>Us</em></h2>
          </div> 
    <p class="lead text-white ">We are here to answer all your questions and provide reliable assistance whenever you need it. Our team is committed to guiding you with clear, timely, and effective support at every step.</p>
</div>


<!-- Contact Section -->
<div class="container mt-5 mb-5 contact-section">
    <div class="row g-4">

        <!-- Left Column: Info -->
        <div class="col-md-6">
             <div class="section-heading">
            <h2> <span>Contact<span> <em>Us</em></h2>
          </div> 
            <p>
                Thank you for contacting Track $Go. We are here to answer your questions, provide support, and assist with any inquiries regarding our tracking services. Our team is dedicated to delivering prompt and reliable assistance. Whether you need guidance, technical help, or information about our services, we are ready to help you every step of the way.
            </p>

            <ul class="list-unstyled mt-4">
                <li class="mb-2"><i class="bi bi-geo-alt-fill"></i> 25-11 41st Ave, Queens, NY 11101, United States</li>
                <li class="mb-2"><i class="bi bi-telephone-fill"></i> (0306)-649-8742 / (888)-649-8772</li>
                <li class="mb-2"><i class="bi bi-envelope-fill"></i> johnsmith13072@gmail.com</li>
                <li class="mb-2"><i class="bi bi-clock-fill"></i> Hours: Monday – Saturday, 9:00 AM – 6:00 PM</li>
            </ul>
        </div>

        <!-- Right Column: Form -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
  <div class="section-heading">
            <h2> Send us a message  <span>News</span></h2>
          </div>                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="message" rows="5" class="form-control" placeholder="How Can We Help You?" required></textarea>
                    </div>
                    <button type="submit" class="btn  w-100" style="background-color:#03a4ed">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

@endsection
