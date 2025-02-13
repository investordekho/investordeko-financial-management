@extends('layouts.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="text-center">Verify OTP</h2>

                <!-- Success or Error Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- OTP Form -->
                <form method="POST" action="{{ route('otp.verify') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter the OTP" required>
                        <label for="otp">Enter OTP</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
