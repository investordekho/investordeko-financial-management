

<?php $__env->startSection('content'); ?>
<div class="container-xxl py-5">
    <div class="conatainer">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Reset Password</h1>
                  <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?> </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                  <?php endif; ?>

                  <form method="POST" action="<?php echo e(route('resetpassword')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="email" value="<?php echo e($email); ?>"> <!-- Hidden field for email -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" required value="<?php echo e(old('password')); ?>">
                        <label for="password">New Password </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password" required value="<?php echo e(old('password_confirmation')); ?>">
                        <label for="password_confirmation">Confirm Password </label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Reset Password </button>
                    </form>
                    <div class="text-center mt-4">
                        <h5>Remembered your password? <a href="<?php echo e(route('login')); ?>">Login</a></h5>
                        <h5>Don't have an account? <a href="<?php echo e(route('register')); ?>">Create Account</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views\auth\new\resetpassword.blade.php ENDPATH**/ ?>