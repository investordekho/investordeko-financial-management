@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Order Confirmation</h1>
    
    <div class="card">
        <div class="card-header">
            <h2>You're about to subscribe to the {{ ucfirst($plan) }} plan</h2>
        </div>
        <div class="card-body">
            <p>Details about the {{ ucfirst($plan) }} plan:</p>

            @if($plan === 'basic')
                <ul>
                    <li>Price: ₹500 / month</li>
                    <li>Basic features: Feature 1, Feature 2, Feature 3</li>
                </ul>
            @elseif($plan === 'premium')
                <ul>
                    <li>Price: ₹1000 / month</li>
                    <li>Premium features: Feature 1, Feature 2, Feature 3, Feature 4</li>
                </ul>
            @elseif($plan === 'pro')
                <ul>
                    <li>Price: ₹1500 / month</li>
                    <li>Pro features: Feature 1, Feature 2, Feature 3, Feature 4, Feature 5</li>
                </ul>
            @endif

            <p>Click the button below to proceed with your subscription:</p>

            <form method="POST" action="{{ route('processOrder') }}">
                @csrf
                <input type="hidden" name="plan" value="{{ $plan }}">
                <button type="submit" class="btn btn-primary">Confirm Subscription</button>
            </form>
        </div>
    </div>
</div>
@endsection
