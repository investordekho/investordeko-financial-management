@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center mb-4">Profile Settings</h2>

   @if(session('success_message'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success_message') }}
    </div>

    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 10000); // 5000ms = 5 seconds
            }
        });
    </script>
@endif

    <!-- Error Message -->
    @if(session('error_message'))
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
    @endif

    <div class="row justify-content-center ">
        <div class="col-md-6 bg-light p-4 rounded shadow-sm">
            <form action="{{ route('profile.update') }}" method="POST" id="profileform" enctype="multipart/form-data" novalidate>
                @csrf

                <!-- Full Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <!-- <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" readonly required> -->
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your full name" required pattern="[A-Za-z\s]+" title="Full name should only contain letters and spaces" readonly>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <!-- <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly required> -->
                     <input 
                               
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                id="email"
                                name="email" 
                                value="{{ old('email', Auth::user()->email) }}"
                                placeholder="Enter your email"
                                pattern="^[a-zA-Z0-9._%+-]+@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$"
                                required
                                readonly
                                title="Please enter a valid email address (e.g.,example@gmail.com)"
                            >    
                             @if ($errors->has('email'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                </div>

                <!-- Phone Number -->
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <!-- <input type="text" class="form-control" id="phone_number" name="phone" value="{{ old('phone', Auth::user()->phone) }}" readonly required> -->
                    <input type="tel" class="form-control phone mt-3" id="phone_number" name="phone"
                    value="{{ old('phone', Auth::user()->phone) }}"
                    placeholder="Enter your phone number e.g. 1234567890"
                    required
                    pattern="^\+?[0-9]{10,14}$"
                    maxlength="14"
                    minlength="10"
                    title="Phone number must be between 10 and 14 digits, can start with a '+' sign"
                    readonly
                    oninput="validatePhoneLength(this)">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
    <!-- Profile Image Section -->
        <div class="row align-items-center mb-4">
            <!-- Profile Image Display -->
            <div class="col-md-3 d-flex justify-content-center">
                @if (Auth::user()->profile_image)
                    <img 
                        src="{{ asset('storage/profile_image/' . Auth::user()->profile_image) }}" 
                        alt="Profile Image" 
                        style="width: 150px; height: 150px; object-fit: cover;" 
                        class="rounded"
                    >
                @else
                    <img 
                        src="{{ asset('storage/profile_image/default_profile_image.png') }}" 
                        alt="Default Profile Image" 
                        style="width: 150px; height: 150px; object-fit: cover;" 
                        class="rounded"
                    >
                @endif
            </div>

            <!-- Profile Image Upload -->
            <div class="col-md-9">
                <label for="profile_image" class="form-label">Upload Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
                <p class="text-muted mt-2 small">Recommended size: 150 x 150 px. Supported formats: JPG, PNG.</p>
            </div>
        </div>
                    <div class="form-group mb-3 d-flex justify-content-between">
                        <!-- Edit Button -->
                        <!-- <button type="button" class="btn btn-secondary me-2 flex-grow-1" onclick="fetchProfileVerificationCode()">Update</button> -->
                        <a href="{{ route('getprofileverificationcode') }}" class="btn btn-secondary me-2 flex-grow-1">Edit Profile</a>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary flex-grow-1">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


<script>
    window.onload = function() {
        var hide = @json(session('hide'));
       
       var $inputname = document.getElementById('name');
       var $inputemail = document.getElementById('email');
       var $inputphone = document.getElementById('phone_number');

            // $inputname.removeAttribute('readonly');
            // $inputemail.removeAttribute('readonly');
            // $inputphone.removeAttribute('readonly');

        if (hide ==="false"){
          
            $inputname.removeAttribute('readonly');
            // $inputemail.removeAttribute('readonly');
            // $inputphone.removeAttribute('readonly');
        }
    };
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("profileform");
    const emailInput = document.getElementById("email");
    const fullNameInput = document.getElementById("name");
    const phoneInput = document.getElementById("phone_number");

    const emailError = document.createElement("div");
    emailError.className = "text-danger mt-1";
    emailInput.parentNode.appendChild(emailError);

    const nameError = document.createElement("div");
    nameError.className = "text-danger mt-1";
    fullNameInput.parentNode.appendChild(nameError);

    const phoneError = document.createElement("div");
    phoneError.className = "text-danger mt-1";
    phoneInput.parentNode.appendChild(phoneError);

    const emailPattern = /^[a-zA-Z0-9._%+-]+@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;
   const phonePattern = /^\+?\d{10,14}$/;


    function validateEmail() {
        const value = emailInput.value.trim();
        if (!emailPattern.test(value)) {
            emailInput.classList.add("is-invalid");
            emailError.textContent = "Enter a valid email like example@gmail.com";
            return false;
        } else {
            emailInput.classList.remove("is-invalid");
            emailError.textContent = "";
            return true;
        }
    }

    function validateName() {
        const nameVal = fullNameInput.value.trim();
        if (!/^[A-Za-z\s]+$/.test(nameVal)) {
            fullNameInput.classList.add("is-invalid");
            nameError.textContent = "Full name should only contain letters and spaces.";
            return false;
        } else if (nameVal === "") {
            fullNameInput.classList.add("is-invalid");
            nameError.textContent = "Full name is required.";
            return false;
        } else {
            fullNameInput.classList.remove("is-invalid");
            nameError.textContent = "";
            return true;
        }
    }

    // Validate phone number length
    function validatePhoneLength(input) {
        if (input.value.length < 10 || input.value.length > 14) {
            input.setCustomValidity("Phone number must be between 10 and 14 digits.");
            phoneError.textContent = "Phone number must be between 10 and 14 digits.";
            input.classList.add("is-invalid");
            return false;
        }
       else if (!/^\+?\d+$/.test(input.value)) {
            input.setCustomValidity("Phone number must contain only digits.");
            phoneError.textContent = "Phone number must contain only digits.";
            input.classList.add("is-invalid");
            return false;
        }
        else if(!phonePattern.test(input.value)) {
            input.setCustomValidity("Phone number must be exactly 10 to 14 digits.");
            phoneError.textContent = "Phone number must be exactly 10 to 14 digits.";
            input.classList.add("is-invalid");
            return false;
        }
         else {
            input.setCustomValidity("");
            phoneError.textContent = "";
            input.classList.remove("is-invalid");
            return true;    
        }
    }

    // Real-time validation
    emailInput.addEventListener("input", validateEmail);
    fullNameInput.addEventListener("input", validateName);

    // One and only form submit listener
    form.addEventListener("submit", function (e) {
        const isEmailValid = validateEmail();
        const isNameValid = validateName();

        console.log("Validation results:", { isEmailValid, isNameValid });

        if (!isEmailValid || !isNameValid || !validatePhoneLength(phoneInput)) {
            e.preventDefault();
            console.log("Form submission blocked due to invalid input.");
        }
    });
});


  

</script>




@endsection
