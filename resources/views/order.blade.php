@extends('layouts.app')

@section('content')
<div style="height: 20px;"></div>
<div class="container">
    <h1 class="my-4 text-center">Order Confirmation</h1>
    
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color:#d6d6c2;">
            <h2 class="mb-0 text-center" style="background-color:#d6d6c2;">Subscription Plan</h2>
        </div>
        <div class="card-body">
            <p class="lead text-center">You have selected the <strong>{{ ucfirst($plan) }}</strong> 
            @if(Auth::user()->category_id == 1)
                <span>Investors Data plan</span>
            @elseif(Auth::user()->category_id == 2)
                <span>Investee Data plan</span>
            @else
                <span>Investors and Investee Data plan</span>
            @endif
            </p>
            <p class="text-center">Total Price: <strong>₹{{ number_format($totalprice, 2) }}</strong></p>

            <div class="mt-4 text-center">
                <h5 class="text-center" style="color: #333;">Plan Details:</h5>
                <ul class="list-group list-group-flush">
                    @if($plan > 10)
                        <li class="list-group-item">Price: ₹499 / info</li>
                        <!-- <li class="list-group-item">Features: Feature 1, Feature 2, Feature 3</li> -->
                    @else
                        <li class="list-group-item">Price: ₹999 / info</li>
                        <!-- <li class="list-group-item">Features: Feature 1, Feature 2, Feature 3, Feature 4</li>                    -->
                    @endif
                </ul>
            </div>

            <div class="text-center mt-4">
                <p>Click the button below to confirm your subscription:</p>
                <form method="POST" action="{{ route('processOrder', ['plan' => $plan, 'totalprice' => $totalprice]) }}">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $plan }}">
                    <button type="submit" id="submit" class="btn btn-success btn-lg">Confirm Subscription</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="height: 20px;"></div>
 
@endsection
