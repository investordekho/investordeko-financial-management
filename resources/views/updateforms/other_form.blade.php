@extends('layouts.app')

@section('content')

<!-- @if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@if (session('error'))
    <div class="alert alert-danger shadow-sm">
        {{ session('error') }}
    </div>
@endif

<style>
    .required::after {
        content: " *";
        color: red;
    }

    .form-section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.75rem;
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }

    #labelinput {
        font-weight: 500;
        font-size: 0.9rem;
    }

    .form-check-label {
        font-size: 0.85rem;
    }

    .spaced-input {
        font-size: 0.875rem;
    }
</style>

<div class="container">
    <!-- Title Section -->
    <div class="row mt-3">
        <div class="col-md-12 text-center bg-primary text-white p-3 rounded-top shadow-sm">
            <h2 class="mb-1" style="font-size: 1.25rem; font-weight: 600;">Submit Your Contact Information</h2>
            <p style="font-size: 0.85rem;">Please fill in your details to help us better understand your needs.</p>
            <div style="width: 40px; height: 2px; background-color: white; margin: 0 auto;"></div>
        </div>
    </div>

    <!-- Form Section -->
    <form id="othersForm" action="{{ route('updateotherprofile') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-bottom shadow-sm mt-0" novalidate>
        @csrf

        <!-- Contact Details -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="form-section-title">Contact Details</div>
                <!-- <div class="form-check" style="text-align: left;">
                    <input type="checkbox" class="form-check-input" id="concerned_person_is_me" onclick="fillConcernedPersonDetails()">
                    <label class="form-check-label text-danger" for="concerned_person_is_me">Concerned Person is Me</label>
                </div> -->
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <!-- <div class="form-section-title">Contact Details</div> -->
                <div class="form-check" style="text-align: left;">
                    <input type="checkbox" class="form-check-input" id="concerned_person_is_me" name="concerned_person_is_me" onclick="fillConcernedPersonDetails()" value="1" {{ old('concerned_person_is_me') ? 'checked': ''}}>
                    <label class="form-check-label text-danger" for="concerned_person_is_me">Concerned Person is Me</label>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label id="labelinput" for="full_name" class="required">Full Name</label>
                    <input type="text" class="form-control spaced-input" id="full_name" name="full_name" value="{{ old('full_name',$other->full_name) }}" required  pattern="^[a-zA-Z\s]+$"
        title="Please enter a valid name (letters and spaces only)"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                     @if ($errors->has('full_name'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('full_name') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-4"> 
                    <label id="labelinput" for="email" class="required">Email</label>
                    <input type="text" class="form-control spaced-input" id="email" name="email" value="{{ old('email',$other->email) }}"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|in)$"
                        title="Please enter a valid .in or .com email address"
                        required
                        autocomplete="email">
                        <div id="email_error" class="text-danger small"></div>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('email') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <label id="labelinput" for="phone_number" class="required">Phone Number</label>
                    <input type="text" class="form-control spaced-input" id="phone_number" name="phone_number" maxlength="20" value="{{ old('phone_number',$other->phone_number) }}"   pattern="^\+?[0-9]{7,20}$" 
                oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" required>
                  @if ($errors->has('phone_number'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('phone_number') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address Section -->
        <div class="mb-4">
            <div class="form-section-title">Address Details</div>
            <div class="mb-3">
                <label id="labelinput" for="address" class="required">Address</label>
                <input type="text" class="form-control spaced-input" id="address" name="address" value="{{ old('address',$other->address) }}" required >
                 @if ($errors->has('address'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('address') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label id="labelinput" for="city" class="required">City</label>
                    <input type="text" class="form-control spaced-input" id="city" name="city" value="{{ old('city',$other->city) }}" required pattern="^[a-zA-Z\s]+$"
        title="Please enter a valid name (letters and spaces only)"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                     @if ($errors->has('city'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('city') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                     @endif
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="state" class="required">State</label>
                    <input type="text" class="form-control spaced-input" id="state" name="state" value="{{ old('state',$other->state) }}" required pattern="^[a-zA-Z\s]+$"
        title="Please enter a valid name (letters and spaces only)"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                     @if ($errors->has('state'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('state') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                     @endif
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="country" class="required">Country</label>
                    <input type="text" class="form-control spaced-input" id="country" name="country" value="{{ old('country',$other->country) }}" required pattern="^[a-zA-Z\s]+$"
        title="Please enter a valid name (letters and spaces only)"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                     @if ($errors->has('country'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('country') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                     @endif
                </div>
            </div>
        </div>

        <!-- Referral Section -->
        <div class="mb-4">
            <div class="form-section-title">How did you hear about Investor Dekho?</div>
            <div class="form-floating">
                <select class="form-select spaced-input" id="referral_source" name="referral_source" required>
                    <option value="" disabled {{ old('referral_source',$other->referral_source) ? '' : 'selected' }}>Select Source</option>
                    <option value="Friend/Family" {{ old('referral_source',$other->referral_source) == 'Friend/Family' ? 'selected' : '' }}>Friend/Family</option>
                    <option value="Social Media (Facebook, Instagram, Twitter/X, etc.)" {{ old('referral_source',$other->referral_source) == 'Social Media (Facebook, Instagram, Twitter/X, etc.)' ? 'selected' : '' }}>Social Media</option>
                    <option value="Online Search (Google, Bing, etc.)" {{ old('referral_source',$other->referral_source) == 'Online Search (Google, Bing, etc.)' ? 'selected' : '' }}>Online Search</option>
                    <option value="Advertisement (TV, Radio, Print)" {{ old('referral_source',$other->referral_source) == 'Advertisement (TV, Radio, Print)' ? 'selected' : '' }}>Advertisement</option>
                    <option value="Email Newsletter" {{ old('referral_source',$other->referral_source) == 'Email Newsletter' ? 'selected' : '' }}>Email Newsletter</option>
                    <option value="Event/Seminar" {{ old('referral_source',$other->referral_source) == 'Event/Seminar' ? 'selected' : '' }}>Event/Seminar</option>
                    <option value="Professional Referral (Doctor, Lawyer, etc.)" {{ old('referral_source',$other->referral_source) == 'Professional Referral (Doctor, Lawyer, etc.)' ? 'selected' : '' }}>Professional Referral</option>
                    <option value="Blog/Website" {{ old('referral_source',$other->referral_source) == 'Blog/Website' ? 'selected' : '' }}>Blog/Website</option>
                    <option value="Direct Mail" {{ old('referral_source',$other->referral_source) == 'Direct Mail' ? 'selected' : '' }}>Direct Mail</option>
                    <option value="Company Website" {{ old('referral_source',$other->referral_source) == 'Company Website' ? 'selected' : '' }}>Company Website</option>
                </select>
                 @if ($errors->has('referral_source'))
                        <div class="alert alert-danger shadow-sm mt-1 mb-0 px-2 py-1" style="font-size: 0.85rem; border-left: 4px solid #dc3545;">
                            <ul class="mb-0 ms-2">
                                @foreach ($errors->get('referral_source') as $error)
                                    <li class="p-0 m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                 @endif
                <label for="referral_source">Referral Source</label>
            </div>
        </div>

        <!-- Terms Section -->
        <!-- <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" required>
            <label class="form-check-label" for="terms">I agree to the <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a></label>
        </div> -->
         <!-- <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : ''}} required>
                        <label class="form-check-label" for="terms">
                            I agree to the 
                            <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms and Conditions</a>
                        </label>
                        @error('terms')
                            <span class="text-danger">You must agree to the Terms and Conditions</span>
                        @enderror
                    </div> -->

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 py-2">Submit</button>
    </form>
</div>

<script>
    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('full_name');
        const phoneField = document.getElementById('phone_number');
        const emailField = document.getElementById('email');

        if (document.getElementById('concerned_person_is_me').checked) {
            nameField.value = "{{ Auth::user()->name }}";
            phoneField.value = "{{ Auth::user()->phone }}";
            emailField.value = "{{ Auth::user()->email }}";

            nameField.readOnly = true;
            phoneField.readOnly = true;
            emailField.readOnly = true;
        } else {
            nameField.value = '';
            phoneField.value = '';
            emailField.value = '';

            nameField.readOnly = false;
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    }

     document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('concerned_person_is_me').checked) {
            fillConcernedPersonDetails();
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const emailvalue = document.getElementById('email');
        const form = document.querySelector('form');
        const formid = document.getElementById('othersForm');
        const emailError = document.getElementById('email_error');
        //real time email validation
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


          emailvalue.addEventListener('input', function () {
            if(!emailPattern.test(emailvalue.value.trim())){
                emailError.textContent = "Please enter a valid email address.e.g.,demo@gmail.com";
            }else{
                emailError.textContent = "";
            }
          });
        // Real-time email validation
        emailvalue.addEventListener('change', function () {
            if (!emailPattern.test(emailvalue.value.trim())) {
                emailError.textContent = 'Please enter a valid email address. e.g.,demo@gmail.com';
            } else {
                emailError.textContent = '';
            }
        });
        formid.addEventListener('submit', function (event) {
            if (!emailPattern.test(emailvalue.value.trim())) {
                emailError.textContent = 'Please enter a valid email address. e.g.,demo@gmail.com';
            } else {
                emailError.textContent = '';
            }
        });
         if (emailvalue.value.trim() !== '' && !emailPattern.test(emailvalue.value.trim())) {
                emailError.textContent = 'Please enter a valid email address. e.g.,demo@gmail.com';
            } else {
                emailError.textContent = '';
            }
        // Form submission validation
        form.addEventListener('submit', function (event) {
            if (!emailPattern.test(emailvalue.value.trim())) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter a valid email address. e.g.,demo@gmail.com');
                emailvalue.focus(); // Set focus back to the email field
            }
            if (emailvalue.value.trim() === '') {
                event.preventDefault(); // Prevent form submission
                alert('Email field cannot be empty.');
            }

    });
    });
</script>


@endsection
