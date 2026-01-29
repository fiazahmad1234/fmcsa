@extends('layout.app')

@section('title', 'About Us')

@section('content')
<section class="about-section py-5 mt-5 mb-5">
    <div class="container mt-5 mb-5">
        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-6">
             <div class="section-heading">
            <h2> About  <span>Us</span></h2></div> <hr class="about-line">

               <p>
                <strong>Our platform</strong> is a trusted solution for businesses seeking accurate,
                fast, and reliable carrier data. With over <strong>12+ years of experience</strong> and
                a proven history of successful implementations, we help companies streamline operations
                and improve decision-making across the transportation and logistics industry.
                </p>

                <p>
                Our tools specialize in fetching verified carrier information, including MC and DOT data,
                while ensuring accuracy, consistency, and real-time updates for seamless business use.
                </p>

                <p>
                We provide powerful <span class="highlight">carrier data fetching</span>,
                <span class="highlight">automated email sending</span>,
                <span class="highlight">smart spam detection</span>, and secure processing solutions.
                From small teams to enterprise-level operations, our services are built to scale with
                your needs.
                </p>

                <p>
                Customer success is our top priority. By using advanced technology, optimized workflows,
                and industry best practices, we deliver fast, secure, and dependable results that exceed
                expectations.
                </p>

            </div>

            <!-- Right Image -->
            <div class="col-lg-6 text-center">
                <div class="about-image">
                    <img src="assets/images/about.jpg" class="img-fluid" alt="Technician">
                </div>
            </div>

        </div>
    </div>
    <section class="services-section py-5">
    <div class="container">

        <h2 class="services-title mb-4">Our Services</h2>

        <div class="row g-4">

            <!-- Service 1 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <h4>Carrier Data Fetching</h4>
                    <p>
                        Our advanced tools automatically fetch verified carrier data using
                        MC numbers and industry databases, ensuring accurate and up-to-date
                        information for logistics and trucking operations.
                    </p>

                    <ul>
                        <li>MC & DOT Number Lookup</li>
                        <li>Carrier Email Extraction</li>
                        <li>Verified Contact Details</li>
                        <li>Real-Time Data Updates</li>
                        <li>Bulk Data Fetching</li>
                    </ul>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <h4>Automated Email Sending</h4>
                    <p>
                        Send bulk emails to carriers quickly and securely using our automated
                        email delivery system designed for high speed and reliability.
                    </p>

                    <ul>
                        <li>Bulk Email Campaigns</li>
                        <li>SMTP & API Integration</li>
                        <li>Scheduled Email Delivery</li>
                        <li>Email Tracking & Logs</li>
                        <li>High Delivery Rate</li>
                    </ul>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <h4>Smart Spam Detection</h4>
                    <p>
                        Our system uses intelligent filtering to prevent spam, reduce bounce
                        rates, and protect your email reputation.
                    </p>

                    <ul>
                        <li>Spam Content Analysis</li>
                        <li>Bounce Detection</li>
                        <li>Email Reputation Protection</li>
                        <li>Blacklist Avoidance</li>
                        <li>Compliance Monitoring</li>
                    </ul>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="col-md-6 col-lg-6">
                <div class="service-card">
                    <h4>Fast & Secure Processing</h4>
                    <p>
                        Our tools are optimized for speed and security, allowing you to process
                        large volumes of carrier data and emails efficiently.
                    </p>

                    <ul>
                        <li>High-Speed Data Processing</li>
                        <li>Secure Data Handling</li>
                        <li>Queue-Based Email Sending</li>
                        <li>Error & Retry Management</li>
                        <li>Scalable Architecture</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

</section>
@endsection
