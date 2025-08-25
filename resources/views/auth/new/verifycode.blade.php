@extends('layouts.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Verify Code</h1>

                <!-- Display Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('verifycode') }}"> <!-- Laravel password reset route -->
                    @csrf <!-- CSRF token is required -->
                    <input type="hidden" name="email" value="{{ $email }}"> <!-- Hidden field for email -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter your code" required value="{{ old('code') }}">
                        <label for="code">Code</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Verify Code</button>
                </form>

                <!-- Login and Register Links -->
                <div class="text-center mt-4">
                    <h5>Remembered your password? <a href="{{ route('login') }}">Login</a></h5>
                    <h5>Don't have an account? <a href="{{ route('register') }}">Create Account</a></h5>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection