 <!-- Assuming you have a layout file -->

<?php $__env->startSection('content'); ?>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Login</h1>

                <!-- Display Error Messages -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>"> <!-- Laravel login route -->
                    <?php echo csrf_field(); ?> <!-- CSRF token is required -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required value="<?php echo e(old('email')); ?>">
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
                    <h5>Don't have an account? <a href="<?php echo e(route('register')); ?>">Create Account</a></h5>
                    <h5><a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<!-- hello -->
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/login.blade.php ENDPATH**/ ?>