<?php $__env->startSection('content'); ?>
<div class="container-fluid page-header mb-1 wow fadeIn" data-wow-delay="0.1s">
</div>

<style>
    #small-center {
        width: 100px;
        margin: 0 auto;
        text-align: center;
    }

    .pricing-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pricing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: 2px solid #ddd;
    }

    .form-group label {
        font-weight: bold;
        font-size: 1rem;
    }

    .price-slab {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        text-align: center;
    }

    .price-slab h5 {
        margin: 0;
        font-size: 1rem;
        color: #333;
    }

    .btn-outline-primary {
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<div class="container">
    <h2 class="text-center mb-5">Choose Your Subscription Plan</h2>
    <div class="row justify-content-center">
        <!-- Investor Plan (Customizable) -->
        <div class="col-md-6">
            <div class="card pricing-card shadow-sm text-center">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0" style="color:white;">Custom Plan</h1>
                </div>
                <div class="card-body">
                    <p class="card-text">Choose the number of investors to manage.</p>

                    <!-- Input for number of investors -->
                    <div class="form-group d-flex justify-content-center align-items-center mb-3">
                        <label for="num_investors" class="form-label me-3">
                            <?php if(Auth::user()->category_id == 1): ?>
                            Number of Investors:
                            <?php elseif(Auth::user()->category_id == 2): ?>
                            Number of Investee 
                            <?php else: ?>
                            Number of Investor and Investee:
                            <?php endif; ?>

                        </label>
                       <input 
                            type="number"
                            id="num_investors"
                            class="form-control"
                            min="1"
                            max="<?php echo e($max_count); ?>"
                            value="1"
                            oninput="calculatePrice()"
                            onchange="calculatePrice()"
                            style="width:100px; text-align:center;"
                            required
                        >

                    </div>

                    <!-- Pricing Slabs -->
                    <div class="price-slab">
                        <h5 id="price_slab_up_to_10">Up to 10 Investors: ₹999 / investor</h5>
                        <h5 id="price_slab_above_10" style="display: none;">Above 10 Investors: ₹499 / investor</h5>
                    </div>

                    <!-- Checkout Button -->
                    <a href="#" id="checkout_link" class="btn btn-outline-primary btn-lg w-100 mt-3" onclick="redirectToCheckout()">
                        Pay ₹<span id="total_price">999</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height: 20px;"></div>
<script>
 function calculatePrice() {
    let input = document.getElementById('num_investors');
    let maxValue = parseInt(input.max);
    let numInvestors = parseInt(input.value);

    // Allow user to type without forcing reset
    if (isNaN(numInvestors)) {
        return; // do nothing until a valid number is entered
    }

    // Limit to max
    if (numInvestors > maxValue) {
        numInvestors = maxValue;
        input.value = maxValue;
    }

    // Force minimum only AFTER valid number exists
    if (numInvestors < 1) {
        numInvestors = 1;
        input.value = 1;
    }

    let priceFirst10 = 999;
    let priceAbove10 = 499;
    let totalPrice = 0;

    if (numInvestors <= 10) {
        totalPrice = numInvestors * priceFirst10;
        document.getElementById('price_slab_up_to_10').style.display = "block";
        document.getElementById('price_slab_above_10').style.display = "none";
    } else {
        totalPrice = numInvestors * priceAbove10;
        document.getElementById('price_slab_up_to_10').style.display = "none";
        document.getElementById('price_slab_above_10').style.display = "block";
    }

    document.getElementById('total_price').innerText = totalPrice;

    let checkoutLink = "<?php echo e(route('order')); ?>";
    document.getElementById('checkout_link').href =
        checkoutLink + '?investors=' + numInvestors + '&price=' + totalPrice;
}



    document.addEventListener('DOMContentLoaded', calculatePrice);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/subscription.blade.php ENDPATH**/ ?>