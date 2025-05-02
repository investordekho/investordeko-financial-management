<?php $__env->startSection('content'); ?>
<div style="height: 20px;"></div>
<div class="container">
    <h1 class="my-4 text-center">Order Confirmation</h1>
    
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color:#d6d6c2;">
            <h2 class="mb-0 text-center" style="background-color:#d6d6c2;">Subscription Plan</h2>
        </div>
        <div class="card-body">
            <p class="lead text-center">You have selected the <strong><?php echo e(ucfirst($plan)); ?></strong> 
            <?php if(Auth::user()->category_id == 1): ?>
                <span>Investors Data plan</span>
            <?php elseif(Auth::user()->category_id == 2): ?>
                <span>Investee Data plan</span>
            <?php else: ?>
                <span>Investors and Investee Data plan</span>
            <?php endif; ?>
            </p>
            <p class="text-center">Total Price: <strong>₹<?php echo e(number_format($totalprice, 2)); ?></strong></p>

            <div class="mt-4 text-center">
                <h5 class="text-center" style="color: #333;">Plan Details:</h5>
                <ul class="list-group list-group-flush">
                    <?php if($plan > 10): ?>
                        <li class="list-group-item">Price: ₹499 / info</li>
                        <!-- <li class="list-group-item">Features: Feature 1, Feature 2, Feature 3</li> -->
                    <?php else: ?>
                        <li class="list-group-item">Price: ₹999 / info</li>
                        <!-- <li class="list-group-item">Features: Feature 1, Feature 2, Feature 3, Feature 4</li>                    -->
                    <?php endif; ?>
                </ul>
            </div>

            <div class="text-center mt-4">
                <p>Click the button below to confirm your subscription:</p>
                <form method="POST" action="<?php echo e(route('processOrder', ['plan' => $plan, 'totalprice' => $totalprice])); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="plan" value="<?php echo e($plan); ?>">
                    <button type="submit" id="submit" class="btn btn-success btn-lg">Confirm Subscription</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="height: 20px;"></div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/order.blade.php ENDPATH**/ ?>