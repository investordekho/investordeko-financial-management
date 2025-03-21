@extends('layouts.app')

@section('content')

<style>
    #Ctext{
        font-size: 14px;
        color: grey;
    }
</style>
<!-- <style>
    /* Define the clockwise rotation animation */
    @keyframes rotateClockwise {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Apply the animation when the class is added */
    .rotate-clockwise {
        animation: rotateClockwise 0.5s ease-in-out;
    }
</style> -->

<!-- <style>
    /* Global Styles */
    body {
        background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
    }
    
    /* Container & Form Card Styling */
    .registration-form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        max-width: 600px;
    }
    
    .registration-form h2 {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        color: #222;
    }
    
    /* Label Styling */
    label#Ctext, label[for="captcha"], label[for="fullName"], label[for="email"], label[for="password"], label[for="password_confirmation"], label[for="category"] {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
        display: block;
    }
    
    /* Input & Select Field Styling */
    .form-control, .form-select {
        width: 100%;
        height: 45px;
        padding: 10px 15px;
        font-size: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }
    
    /* Input Group for Country Code & Phone */
    .input-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .input-group .form-select {
        flex: 0 0 150px;
        margin-right: 10px;
        background-color: #f8f9fa;
    }
    
    .phone {
        flex: 1;
    }
    
    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        width: 100%;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    
    /* Refresh Icon Styling */
    #refreshIcon {
        cursor: pointer;
        width: 25px;
        margin-left: 10px;
        transition: transform 0.5s ease-in-out;
    }
    
    #refreshIcon:hover {
        opacity: 0.8;
    }
    
    /* Alert Messages */
    .alert {
        border-radius: 5px;
        font-size: 14px;
        padding: 10px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .registration-form {
            padding: 20px;
            margin: 20px;
        }
        
        .btn-primary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
    
    /* Rotation Animation (for refresh icon) */
    @keyframes rotateClockwise {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .rotate-clockwise {
        animation: rotateClockwise 0.5s ease-in-out;
    }
</style> -->
<style>
    /* Global Styles */
    body {
        background: linear-gradient(135deg, #f7f9fc, #e2e8f0);
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
    }
    
    /* Registration Form Container */
    .registration-form {
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 12px;
        border: 2px solid #ccc;  /* Changed border color to #ccc for better visibility */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 60px auto;
        transition: border-color 0.3s ease;
    }
    
    .registration-form:hover {
        border-color: #999; /* Darker border on hover */
    }
    
    .registration-form h2 {
        font-size: 30px;
        font-weight: 600;
        color: #222;
        text-align: center;
        margin-bottom: 30px;
    }
    
    /* Label Styling */
    label {
        font-size: 14px;
        color: #555;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
    }
    
    /* Input and Select Fields */
    .form-control,
    .form-select {
        width: 100%;
        padding: 12px 15px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.3s, box-shadow 0.3s;
        color: #555;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        outline: none;
    }
    
    /* Input Group for Country Code and Phone Number */
    .input-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .input-group .form-select {
        flex: 0 0 150px;
        margin-right: 10px;
        background-color: #f8f9fa;
    }
    
    .phone {
        flex: 1;
    }
    
    /* Refresh Icon Styling */
    #refreshIcon {
        cursor: pointer;
        width: 25px;
        margin-left: 10px;
        transition: transform 0.5s ease-in-out;
    }
    
    #refreshIcon:hover {
        opacity: 0.8;
    }
    
    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        width: 100%;
        transition: background-color 0.3s, transform 0.3s;
        margin-top: 20px;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    
    /* Alert Messages */
    .alert {
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .registration-form {
            padding: 20px;
            margin: 20px;
        }
        
        .btn-primary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
    
    /* Rotation Animation for Refresh Icon */
    @keyframes rotateClockwise {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .rotate-clockwise {
        animation: rotateClockwise 0.5s ease-in-out;
    }
</style>






<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="text-center">Signup Now</h2>

                <!-- Display Success or Error Messages -->
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name and Email Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                            
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                            
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                      <div class="row g-3">

                    <!-- Phone Number Field Covering Full Line -->
                    <div class="form-auto mb-1">
                        <div class="input-group" style="margin-bottom: -10px;">
                            <!-- Country Code Dropdown -->
                            <select class="form-select p-1" name="country_code" id="country_code" required style="max-width: 150px;">
                                @include('partials.countryphonecode')
                                <!-- Add more country codes as needed -->
                            </select>

                            <!-- Phone Number Input -->
                            <input type="number" class="form-control phone" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required maxlength="10">
                        </div>
                        <label for="phone"></label>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <!-- Password and Password Confirmation Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="form-auto mb-3">
                         <label id="Ctext" for="category">Join as</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                       
                        @error('category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CAPTCHA Field -->
                  
                    <!-- <div class="form-auto mb-3">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter the result" required>
                        <label id="Ctext" for="captcha">What is {{ session('captcha_value_1') }}?</label>
                        @error('captcha')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> -->

                    <div class="form-group mb-3">
                        <label for="captcha">Enter the text shown in the image:</label>
                        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter CAPTCHA" required>
                        <br>
                        <img id="captchaImage" src="{{ url('/captcha') }}" alt="CAPTCHA Image">
                        <!-- <button type="button" onclick="document.querySelector('img[alt=\'CAPTCHA Image\']').src = '{{ url('/captcha') }}?' + Math.random();">
                            Reload CAPTCHA
                        </button> -->
                        <img src="{{ asset('img/refresh.png') }}" id="refreshIcon" alt="Refresh CAPTCHA" style="cursor: pointer; width:25px; margin-left:10px;" onclick="refreshCaptcha()">

                        @error('captcha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms and Conditions Checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            By clicking to register, I agree to the <a href="{{ route('terms') }}">Terms of Use</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
                        </label>
                        @error('terms')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Register</button>
                </form>

                <!-- Already have an account -->
                <h3 class="text-center mt-4">Already have an account? <a href="{{ route('login') }}">Login</a></h3>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function refreshCaptcha() {
        var captchaImage = document.getElementById('captchaImage');
        // Append a random query string to prevent caching
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();
    }
</script> -->
<!-- <script>
    function refreshCaptcha() {
        // Refresh the CAPTCHA image by appending a random query string to avoid caching
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();
        
        // Get the refresh icon and apply the rotation effect
        var refreshIcon = document.getElementById('refreshIcon');
        refreshIcon.style.transition = "transform 0.5s ease-in-out";
        refreshIcon.style.transform = "rotate(360deg)";
        
        // Reset the rotation after the animation completes (0.5 seconds)
        setTimeout(function() {
            refreshIcon.style.transform = "rotate(0deg)";
        }, 500);
    }
</script> -->
<script>
    function refreshCaptcha() {
        // Refresh the CAPTCHA image by appending a random query string to avoid caching
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = '{{ url('/captcha') }}?' + Math.random();

        // Get the refresh icon and add the rotation class to trigger the animation
        var refreshIcon = document.getElementById('refreshIcon');

        // Remove the class if it's already there, then force a reflow before adding it again.
        refreshIcon.classList.remove('rotate-clockwise');
        void refreshIcon.offsetWidth; // This forces reflow, so the animation will re-trigger
        refreshIcon.classList.add('rotate-clockwise');
    }
</script>
@endsection
