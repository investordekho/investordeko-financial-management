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
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Full Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" readonly required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone" value="{{ old('phone', Auth::user()->phone) }}" readonly required>
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
            $inputemail.removeAttribute('readonly');
            $inputphone.removeAttribute('readonly');
        }
    };
</script>


@endsection
