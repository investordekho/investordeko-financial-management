@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5 display-6 fw-bold">Order Confirmation</h1>

    <!-- Plan & Amount -->
    <div class="text-center mb-5">
        <p class="fs-5 mb-2">
            <strong class="text-dark">Plan:</strong>
            <span class="text-muted">{{ $plan }}</span>
        </p>
        <p class="fs-5">
            <strong class="text-dark">Amount:</strong>
            <span class="text-muted">{{ $totalprice }}</span>
        </p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Bank Transfer Option -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
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
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <h4 class="text-primary fw-semibold mb-4">QR Code / UPI</h4>
                    <p class="text-muted mb-4">Scan the QR code below to make the payment</p>
                    <img src="{{ asset('img/payment.jpeg') }}" alt="QR Code" class="img-fluid rounded-3 border" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="text-center mb-5">
        <p class="text-muted mb-1">Please make the payment using one of the above options, then enter your details and confirm the payment.</p>
        <p class="text-muted">Once the payment is confirmed, access will be granted within 24 hours.</p>
    </div>

    <!-- User Info & Confirmation -->
    <div class="card shadow-sm border-0 rounded-4 mx-auto p-4" style="max-width: 600px;">
        <h5 class="text-primary fw-semibold mb-3 text-center">Confirm Your Payment</h5>
        <p class="text-muted text-center mb-4">Please provide the details from which you made the payment</p>
        <form action="{{ route('createsubscriptionrequest')}}" method="POST" enctype="multipart/form-data" id="payment_detail">
            @csrf
            <input type="hidden" name="no_of_data" value="{{ $plan}}">
            <input type="hidden" name="plan_amount" value="{{$totalprice}}">
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select" required>
                    <option value="">Select...</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="upi">UPI / QR</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="transaction_id" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transaction_id" name="transaction_id" required placeholder="Enter Transaction ID or UTR">
            </div>
            <div class="mb-3">
                <label for="reference_id" class="form-label">Reference Id</label>
                <input type="text" class="form-control" id="reference_id" name="reference_id" required placeholder="Enter Referance Id or UTR">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number Used for Payment</label>
                <input type="text" class="form-control" id="phone" name="phone" required placeholder="e.g. +91 9876543210">
            </div>
            <div class="mb-3">
                <label for="screenshot" class="form-label">Upload Screenshot</label>
                <input type="file" class="form-control" id="screenshot" name="screenshot" accept="image/*" required>
            </div>           
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-pill py-2 shadow-sm">
                    Confirm Payment & Request For the Access
                </button>
            </div>  
            
            <!-- <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-5 py-2 shadow-sm">
                    Confirm & Go to Home
                </a>
            </div> -->
        </form>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

    </div>

   
</div>
@endsection
