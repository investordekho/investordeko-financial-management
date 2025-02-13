@extends('layouts.app')

@section('content')
<div class="container-fluid page-header mb-1 wow fadeIn" data-wow-delay="0.1s">
   <!-- <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Pricing</h1>
    </div> -->
</div>

<style>
    #small-center {
    width: 100px;
    margin: 0 auto;
    text-align: center;
}
</style>
<div class="container">
    <h2 class="text-center mb-5">Choose Your Subscription Plan</h2>
    <div class="row g-4">
        <!-- Investor Plan (Customizable) -->
        <div class="col-md-6 offset-md-3">
            <div class="card pricing-card shadow-sm text-center">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0" style="color:white;">Custom Plan</h1>
                </div>
                <div class="card-body">
                    <p class="card-text">Choose the number of investors to manage.</p>

                    <!-- Input for number of investors and price text in a single line -->
                    <div class="form-group d-flex justify-content-center align-items-center mb-3">
                        <label for="num_investors" class="form-label me-3" style="margin-bottom: 0;">
                            <strong>Number of Investors:</strong>
                        </label>
                        <input 
                            type="number" 
                            id="num_investors" 
                            style="width: 100px; text-align: center;" 
                            class="form-control d-inline-block" 
                            min="1" 
                            value="1" 
                            onchange="calculatePrice()" 
                            required>
                    </div>
                    <div style="width: auto; background: #e6e1e1; padding: 10px; margin: 4px; border: 1px #e6e1e1 solid;">
                        <!-- Static Pricing Slabs -->
                        <h5 class="my-1" id="price_slab_up_to_10">Up to 10 Investors: ₹999 / investor</h5>
                        <h5 class="my-1" id="price_slab_above_10">Above 10 Investors: ₹499 / investor</h5>
                    </div>

                    <!-- Checkout Button with Dynamic Total Price -->
                    <a href="#" id="checkout_link" class="btn btn-outline-primary btn-lg w-100 mt-2" onclick="redirectToCheckout()">
                        Pay ₹<span id="total_price">999</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calculatePrice() {
        // Get the number of investors
        let numInvestors = parseInt(document.getElementById('num_investors').value);

        // Pricing details
        let priceFirst10 = 999; // Price per investor for up to 10 investors
        let priceAbove10 = 499; // Price per investor for above 10 investors

        // Calculate total price
        let totalPrice = 0;
        if (numInvestors <= 10) {
            totalPrice = numInvestors * priceFirst10; // ₹999 per investor for 10 or fewer investors

            // Display both slabs
            document.getElementById('price_slab_up_to_10').style.display = "block";
            document.getElementById('price_slab_above_10').style.display = "block";
        } else {
            totalPrice = numInvestors * priceAbove10; // ₹499 per investor for more than 10 investors

            // Display only the "Above 10" slab
            document.getElementById('price_slab_up_to_10').style.display = "none";
            document.getElementById('price_slab_above_10').style.display = "block";
        }

        // Update the total price on the button
        document.getElementById('total_price').innerText = totalPrice;

        // Update checkout link dynamically
        let checkoutLink = "{{ route('order', ['plan' => 'custom']) }}";
        document.getElementById('checkout_link').href = checkoutLink + '?investors=' + numInvestors + '&price=' + totalPrice;
    }

    function redirectToCheckout() {
        // Additional checkout logic can be implemented here
        return true; // Proceed to checkout
    }

    // Initialize price calculation on page load
    document.addEventListener('DOMContentLoaded', calculatePrice);
</script>


@endsection
