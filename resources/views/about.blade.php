@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 50px 0;">
    <div class="container">
        <h1 class="display-5 mb-4 animated slideInDown">About Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- About Section Start -->
<div class="container-xxl py-5">
    <div class="container">
        <!-- Section Image and Content -->
        <div class="row g-4 align-items-end mb-4" style="padding-bottom: 40px;">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <img src="{{ asset('img/about.jpg') }}" alt="About Us" class="about-img shadow-lg" style="max-width: 100%; border-radius: 10px;">
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">What We Do</p>
                <h1 class="display-5 mb-4">Empowering Startups & Investors in India</h1>
                <p class="mb-4">
                    Our platform serves as a central hub for startups and investors in India. We curate a vast database of startups, providing detailed profiles that showcase their business plans, team, market potential, and funding requirements.
                </p>
                <h2>Our Unique Value Proposition:</h2>
                <ul>
                    <li><strong>Comprehensive Database:</strong> Wide range of startups from early-stage ventures to established SMEs.</li>
                    <li><strong>Advanced Matching Algorithms:</strong> Sophisticated algorithms connect startups with suitable investors.</li>
                    <li><strong>Investor Profiles:</strong> Detailed investor profiles include preferences, past investments, and contact information.</li>
                    <li><strong>Data-Driven Insights:</strong> Analytics and insights help startups and investors make informed decisions.</li>
                </ul>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="row g-4 align-items-end mb-4" style="padding-bottom: 40px;">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                <h4>Why Choose Us:</h4>
                <ul>
                    <li><strong>Accessibility:</strong> A user-friendly platform accessible to startups and investors of all sizes.</li>
                    <li><strong>Efficiency:</strong> Streamlines the fundraising process, saving time for both startups and investors.</li>
                    <li><strong>Transparency:</strong> Clear and transparent information about startups and investors.</li>
                </ul>
            </div>
        </div>

        <!-- Vision and Mission Section -->
        <div class="border-box wow fadeInUp shadow-lg p-4" data-wow-delay="0.1s" style="padding: 40px; border-radius: 10px;">
            <div class="row g-4">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our Vision</p>
                    <h4>Empowering the Indian Startup Ecosystem</h4>
                    <p>We aim to empower Indian startups by providing a platform that connects them with investors, democratizing access to capital, and fostering a thriving entrepreneurial ecosystem in India.</p>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Our Mission</p>
                    <h4>Trusted Partner for Entrepreneurs</h4>
                    <p>We strive to be the trusted partner of choice for entrepreneurs, delivering quality and trustworthy services for all stakeholders.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Section End -->
@endsection
