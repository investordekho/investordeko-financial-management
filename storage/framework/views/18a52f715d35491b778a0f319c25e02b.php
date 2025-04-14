<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="my-4">Order Confirmation</h1>
    
    <div class="card">
        <div class="card-header">
            <h2>You're about to subscribe to the <?php echo e(ucfirst($plan)); ?> plan</h2>
        </div>
        <div class="card-body">
        <p>You have selected the <?php echo e(ucfirst($plan)); ?> plan. Total price: <?php echo e(ucfirst($totalprice)); ?></p>


            <?php if($plan === 'basic'): ?>
                <ul>
                    <li>Price: ₹500 / month</li>
                    <li>Basic features: Feature 1, Feature 2, Feature 3</li>
                </ul>
            <?php elseif($plan === 'premium'): ?>
                <ul>
                    <li>Price: ₹1000 / month</li>
                    <li>Premium features: Feature 1, Feature 2, Feature 3, Feature 4</li>
                </ul>
            <?php elseif($plan === 'pro'): ?>
                <ul>
                    <li>Price: ₹1500 / month</li>
                    <li>Pro features: Feature 1, Feature 2, Feature 3, Feature 4, Feature 5</li>
                </ul>
            <?php endif; ?>

            <p>Click the button below to proceed with your subscription:</p>

            <form method="POST" action="<?php echo e(route('processOrder',['plan' => $plan,'totalprice' => $totalprice])); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="plan" value="<?php echo e($plan); ?>">
                <button type="submit" class="btn btn-primary">Confirm Subscription</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/order.blade.php ENDPATH**/ ?>