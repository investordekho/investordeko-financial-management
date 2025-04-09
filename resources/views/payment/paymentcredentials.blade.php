@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-6 fw-bold">Order Confirmation</h1>

     <!-- Plan & Amount -->
     <div class="text-center mt-5">
        <p style="margin-bottom: 12px; font-size: 1.25rem;">
            <strong style="font-weight: 600; color: #212529;">Plan:</strong>
            <span style="color: #6c757d; font-weight: 500;">{{ $plan }}</span>
        </p>
        <p style="font-size: 1.25rem;">
            <strong style="font-weight: 600; color: #212529;">Amount:</strong>
            <span style="color: #6c757d; font-weight: 500;">{{ $totalprice }}</span>
        </p>
    </div>
    <div class="row g-4">
        
        <!-- Bank Transfer Option -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100 transition">
                <div class="card-body text-center p-4">
                    <h4 class="text-primary fw-semibold mb-4">Bank Transfer</h4>
                    <div class="text-start mx-auto" style="max-width: 300px;">
                        <p><strong>Account Number:</strong> <span class="text-muted">1234567890</span></p>
                        <p><strong>IFSC Code:</strong> <span class="text-muted">SBIN0001234</span></p>
                        <p><strong>Account Holder:</strong> <span class="text-muted">John Doe</span></p>
                        <p><strong>Bank Name:</strong> <span class="text-muted">State Bank of India</span></p>
                        <p><strong>Branch:</strong> <span class="text-muted">Main Branch</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Code / UPI Option -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100 transition">
                <div class="card-body text-center p-4">
                    <h4 class="text-primary fw-semibold mb-4">QR Code / UPI</h4>
                    <p class="text-muted mb-4">Scan the QR code below to make the payment</p>
                    <img src="{{ asset('img/payment.jpeg') }}" alt="QR Code" class="img-fluid rounded-3 border" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>


    <!-- Instructions -->
    <div class="text-center mt-4">
        <p class="text-muted">Please make the payment using one of the above options, then click the button below to confirm your payment.</p>
        <p class="text-muted">Once the payment is confirmed, access will be granted within 24 hours.</p>
    </div>

    <!-- Confirm Button -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
            Confirm Payment & Go to Home
        </a>
    </div>
</div>
@endsection
