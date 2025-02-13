@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')

<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Login</h1>

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

                <form method="POST" action="{{ route('login') }}"> <!-- Laravel login route -->
                    @csrf <!-- CSRF token is required -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Login</button>
                </form>

                <!-- Register and Forgot Password Links -->
                <div class="text-center mt-4">
                    <h5>Don't have an account? <a href="{{ route('register') }}">Create Account</a></h5>
                    <h5><a href="{{ route('password.request') }}">Forgot Password?</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- hello -->