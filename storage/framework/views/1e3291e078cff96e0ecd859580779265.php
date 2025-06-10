<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 class="text-center mb-4">Profile Settings</h2>

    <!-- Success Message -->
    <?php if(session('success_message')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success_message')); ?>

        </div>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if(session('error_message')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error_message')); ?>

        </div>
    <?php endif; ?>

    <div class="row justify-content-center ">
        <div class="col-md-6 bg-light p-4 rounded shadow-sm">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <!-- Full Name -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" readonly required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" readonly required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Phone Number -->
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone" value="<?php echo e(old('phone', Auth::user()->phone)); ?>" readonly required>
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
    <!-- Profile Image Section -->
        <div class="row align-items-center mb-4">
            <!-- Profile Image Display -->
            <div class="col-md-3 d-flex justify-content-center">
                <?php if(Auth::user()->profile_image): ?>
                    <img 
                        src="<?php echo e(asset('storage/profile_image/' . Auth::user()->profile_image)); ?>" 
                        alt="Profile Image" 
                        style="width: 150px; height: 150px; object-fit: cover;" 
                        class="rounded"
                    >
                <?php else: ?>
                    <img 
                        src="<?php echo e(asset('storage/profile_image/default_profile_image.png')); ?>" 
                        alt="Default Profile Image" 
                        style="width: 150px; height: 150px; object-fit: cover;" 
                        class="rounded"
                    >
                <?php endif; ?>
            </div>

            <!-- Profile Image Upload -->
            <div class="col-md-9">
                <label for="profile_image" class="form-label">Upload Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
                <p class="text-muted mt-2 small">Recommended size: 150 x 150 px. Supported formats: JPG, PNG.</p>
            </div>
        </div>
                    <div class="form-group mb-3 d-flex justify-content-between">
                        <!-- Edit Button -->
                        <!-- <button type="button" class="btn btn-secondary me-2 flex-grow-1" onclick="fetchProfileVerificationCode()">Update</button> -->
                        <a href="<?php echo e(route('getprofileverificationcode')); ?>" class="btn btn-secondary me-2 flex-grow-1">Edit Profile</a>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary flex-grow-1">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


<script>
    window.onload = function() {
        var hide = <?php echo json_encode(session('hide'), 15, 512) ?>;
       
       var $inputname = document.getElementById('name');
       var $inputemail = document.getElementById('email');
       var $inputphone = document.getElementById('phone_number');

            // $inputname.removeAttribute('readonly');
            // $inputemail.removeAttribute('readonly');
            // $inputphone.removeAttribute('readonly');

        if (hide ==="false"){
          
            $inputname.removeAttribute('readonly');
            $inputemail.removeAttribute('readonly');
            $inputphone.removeAttribute('readonly');
        }
    };
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views\profile\settings.blade.php ENDPATH**/ ?>