@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                <style>
                    .required::after {
                        content: " *";
                        color: red;
                    }
                </style>
                <div class="container">

                <form id="othersForm" action="{{ route('form.other.submit') }}" method="POST" enctype="multipart/form-data" class="bg-light p-5 rounded shadow-sm">
    @csrf
    <!-- Contact Details Section -->
   
    <div class="row g-4 mb-3">
        <div class="col-sm-2">
        <h3 style="font-size: 22px; font-weight: 600;">Contact Details</h3>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="concerned_person_is_me" onclick="fillConcernedPersonDetails()">
        <label class="form-check-label" for="concerned_person_is_me" style="font-size: 12px; color: red;">Concerned Person is Me</label>
    </div>

                </div>
        <div class="col-sm-3">
            <label id="labelinput" for="full_name">Full Name</label>
            <input type="text" class="form-control spaced-input" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
        </div>
        <div class="col-sm-3">
            <label id="labelinput" for="email">Email</label>
            <input type="email" class="form-control spaced-input" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="col-sm-4">
            <label id="labelinput" for="phone_number">Phone Number</label>
            <input type="tel" class="form-control spaced-input" id="phone_number" name="phone_number" maxlength="10" value="{{ old('phone_number') }}" required>
        </div>
    </div>

    <!-- Address Details Section -->
    <h3>Address Details</h3>
    <div class="col-sm-12">
        <label id="labelinput" for="address">Address</label>
        <input type="text" class="form-control spaced-input" id="address" name="address" value="{{ old('address') }}" required>
    </div>
    <div class="row g-4 mb-3">
        <div class="col-sm-4">
            <label id="labelinput" for="city">City</label>
            <input type="text" class="form-control spaced-input" id="city" name="city" value="{{ old('city') }}" required>
        </div>
        <div class="col-sm-4">
            <label id="labelinput" for="state">State</label>
            <input type="text" class="form-control spaced-input" id="state" name="state" value="{{ old('state') }}" required>
        </div>
        <div class="col-sm-4">
            <label id="labelinput" for="country">Country</label>
            <input type="text" class="form-control spaced-input" id="country" name="country" value="{{ old('country') }}" required>
        </div>
    </div>

    <!-- Referral Source Section -->
    <h3>How did you hear about Investor Dekho?</h3>
    <div class="form-floating mb-3">
        <select class="form-control spaced-input" id="referral_source" name="referral_source" required>
            <option value="" disabled selected>Select Source</option>
            <option value="Friend/Family">Friend/Family</option>
            <option value="Social Media (Facebook, Instagram, Twitter, etc.)">Social Media (Facebook, Instagram, Twitter, etc.)</option>
            <option value="Online Search (Google, Bing, etc.)">Online Search (Google, Bing, etc.)</option>
            <option value="Advertisement (TV, Radio, Print)">Advertisement (TV, Radio, Print)</option>
            <option value="Email Newsletter">Email Newsletter</option>
            <option value="Event/Seminar">Event/Seminar</option>
            <option value="Professional Referral (Doctor, Lawyer, etc.)">Professional Referral</option>
            <option value="Blog/Website">Blog/Website</option>
            <option value="Direct Mail">Direct Mail</option>
            <option value="Company Website">Company Website</option>
        </select>
        <label for="referral_source">Referral Source</label>
    </div>

    <!-- Terms and Conditions Section -->
    <div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" required>
    <label class="form-check-label" for="terms">I agree to the <a href="{{ route('terms') }}">Terms and Conditions</a></label>
</div>


    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Submit</button>
</form>

<script>
    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('full_name'); // Corrected ID
        const phoneField = document.getElementById('phone_number');
        const emailField = document.getElementById('email');

        if (document.getElementById('concerned_person_is_me').checked) {
            // Populate the fields with the logged-in user's details
            nameField.value = "{{ Auth::user()->name }}";
            phoneField.value = "{{ Auth::user()->phone }}";
            emailField.value = "{{ Auth::user()->email }}";
            
            // Make the fields read-only
            nameField.readOnly = true;
            phoneField.readOnly = true;
            emailField.readOnly = true;
        } else {
            // Reset the fields and make them editable again
            nameField.value = '';
            phoneField.value = '';
            emailField.value = '';
            
            nameField.readOnly = false;
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    }
</script>
@endsection
