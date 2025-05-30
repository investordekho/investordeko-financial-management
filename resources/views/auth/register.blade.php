@extends('layouts.app')

@section('content')

<style>
    #Ctext{
        font-size: 14px;
        color: grey;
    }
</style>

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
                <h2 class="text-center" style="bold; color:blue;">Hello there!</h2>
                <h3 class="text-center">Let's create an account</h3>
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
                <form method="POST" action="{{ route('register') }}" style="background-color: #f8f9fa; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    @csrf
                    <!-- Full Name and Email Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="fullName">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="fullName" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required pattern="[A-Za-z\s]+" title="Full name should only contain letters and spaces">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>                            
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                      <div class="row g-3">
                    <!-- Phone Number Field Covering Full Line -->
                    <div class="form-auto mb-1">
                        <div class="input-group" style="margin-bottom: -10px;">
                            <div class="mr-3" style="margin-right: 10px;">
                                <!-- Phone Label on Top -->
                                <label for="country_code">Phone <span class="text-danger mb-4">*</span></label>
                                <!-- Country Code Dropdown -->
                                <div style="position: relative; width: 150px;">
                                    <select class="form-select p-1" name="country_code" id="country_code" required style="max-width: 150px;">
                                        @include('partials.countryphonecode')
                                    </select>
                                </div>
                            </div>
                            <!-- Phone Number Input -->
                            <input type="tel" class="form-control phone mt-3" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required pattern="[0-9]{10,14}" maxlength="14" minlength="10" oninput="validatePhoneLength(this)">
                        </div>
                        <label for="phone"></label>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>

                    <!-- Password and Password Confirmation Fields on the Same Line -->
                    <div class="row g-3" style="margin-top: 3px;">
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password">Password<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            
                            <div id="passwordmsgid" style="display:none;">
                                <div class="text-danger">Password do not match</div>
                                <!-- @error('password_confirmation')
                                <div class="text-danger">Password do not match</div>
                                @enderror -->
                            </div>
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="form-auto mb-3">
                         <label id="Ctext" for="category">Join as <span class="text-danger">*</span></label>
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

                    <div class="form-group mb-3">
                        <label for="captcha">Enter the text shown in the image: <span class="text-danger">*</span></label>
                        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter CAPTCHA" required>
                        <br>
                        <img id="captchaImage" src="{{ url('/captcha') }}" alt="CAPTCHA Image">
                        <img src="{{ asset('img/refresh.png') }}" id="refreshIcon" alt="Refresh CAPTCHA" style="cursor: pointer; width:25px; margin-left:10px;" onclick="refreshCaptcha()">
                        
                        <div id="captchaerrormsgdiv" style="display:none;">
                            <div class="text-danger">Incorrect Captcha Enter</div>
                        </div>
                        @error('captcha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms and Conditions Checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            By clicking to register, I agree to the <a href="{{ route('terms') }}" target="_blank">Terms of Use</a> and <a href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a>.
                        </label>
                        @error('terms')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Register</button>
                </form>

                <!-- Already have an account -->
                <h4 class="text-center mt-4">Already have an account? <a href="{{ route('login') }}">Login</a></h4>
            </div>
        </div>
    </div>
</div>


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

    function validatePhoneLength(input) {
        if (input.value.length < 10) {
            input.setCustomValidity("Phone number must be exactly 10 digits.");
        } else {
            input.setCustomValidity("");
        }
    }

     let passwordinput = document.getElementById("password");
     let confirmpasswordinput = document.getElementById("password_confirmation");
     let passwordmsgdiv = document.getElementById("passwordmsgid");

      function confirmpassword() {
        if(passwordinput.value !== confirmpasswordinput.value){
            passwordmsgdiv.style.display = "block";
            confirmpasswordinput.style.borderColor = "red";
        }
        else{
            passwordmsgdiv.style.display = "none";
            confirmpasswordinput.style.borderColor = "";
        }
     }

    //  passwordinput.addEventListener("input", confirmpassword);
     confirmpasswordinput.addEventListener("input", confirmpassword);

     let countrycodeInput = document.getElementById("country_code_input");
     let countrycodeSelect = document.getElementById("country_code");
        countrycodeInput.addEventListener("input", function(){
        // Update the select element's value based on the input
        countrycodeSelect.value = countrycodeInput.value;
        
        })
</script>
@endsection
