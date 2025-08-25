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
               
                    <!-- i want to show only 4 last number and other number as X -->
                         <!-- <p class="text-left mb-4">{{ session('phone') }}</p> -->

                    <p class="text-left mb-3" style="font-size: 0.75rem; letter-spacing: 1px; background: #f8f9fa; padding: 8px 14px; border-radius: 6px; border: 1px solid #e3e3e3;">
                        @php 
                            $phone = session('phone');
                            $country_code = session('country_code') ?? '';
                            if ($phone && strlen($phone) >= 4) {
                                $maskedphone = $country_code . '-' . str_repeat('X', strlen($phone) - 4) . substr($phone, -4);
                            } else {
                                $maskedphone = $country_code . '-' . $phone;
                            }
                        @endphp
                        An OTP has been sent to your number {{ $maskedphone }}. Please enter it below to verify.
                    </p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter the OTP" required>
                        <label for="otp">Enter OTP</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Verify OTP</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('otp.resend',['phone'=> old('phone',session('phone'))]) }}" class="text-decoration-none">Resend OTP</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
