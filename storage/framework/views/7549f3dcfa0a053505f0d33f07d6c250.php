<?php $__env->startSection('content'); ?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="text-center">Verify OTP</h2>

                <!-- Success or Error Message -->
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <!-- OTP Form -->
                <form method="POST" action="<?php echo e(route('otp.verify')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter the OTP" required>
                        <label for="otp">Enter OTP</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/verify_otp.blade.php ENDPATH**/ ?>