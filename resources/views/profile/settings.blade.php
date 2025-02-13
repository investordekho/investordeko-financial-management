@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center mb-4">Profile Settings</h2>

    <!-- Success Message -->
    @if(session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
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
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
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
                src="{{ asset('images/default_profile.png') }}" 
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
        <p class="text-muted mt-2 small">Recommended size: 150x150px. Supported formats: JPG, PNG.</p>
    </div>
</div>


                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
