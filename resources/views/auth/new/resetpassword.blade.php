@extends('layouts.app')

@section('content')
<div class="container-xxl py-5">
    <div class="conatainer">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Reset Password</h1>
                  @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                  @endif

                  <form method="POST" action="{{ route('resetpassword') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}"> <!-- Hidden field for email -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" required value="{{ old('password') }}">
                        <label for="password">New Password </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password" required value="{{ old('password_confirmation') }}">
                        <label for="password_confirmation">Confirm Password </label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Reset Password </button>
                    </form>
                    <div class="text-center mt-4">
                        <h5>Remembered your password? <a href="{{ route('login') }}">Login</a></h5>
                        <h5>Don't have an account? <a href="{{ route('register') }}">Create Account</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection