

<?php $__env->startSection('content'); ?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-5 mb-4 text-center">Verify Code</h1>

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

                <form method="POST" action="<?php echo e(route('verifyemailforupdateprofle')); ?>"> <!-- Laravel password reset route -->
                    <?php echo csrf_field(); ?> <!-- CSRF token is required -->
                    <input type="hidden" name="email" value="<?php echo e($email); ?>"> <!-- Hidden field for email -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter your code" required value="<?php echo e(old('code')); ?>">
                        <label for="code">Code</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Verify Code</button>
                </form>

            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/new/updateprofile.blade.php ENDPATH**/ ?>