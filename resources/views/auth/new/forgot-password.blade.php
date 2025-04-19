@extends('layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Forgot Password</h1>

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

                <form method="POST" action="{{ route('sendmail') }}"> <!-- Laravel password reset route -->
                    @csrf <!-- CSRF token is required -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                        <label for="email">Email</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Send Password Reset Link</button>
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
