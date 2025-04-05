<?php $__env->startSection('content'); ?>

<style>
    #Ctext{
        font-size: 14px;
        color: grey;
    }
</style>

<style>
    /* Global Styles */
    body {
        background: linear-gradient(135deg, #f7f9fc, #e2e8f0);
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
    }
    
    /* Registration Form Container */
    .registration-form {
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 12px;
        border: 2px solid #ccc;  /* Changed border color to #ccc for better visibility */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 60px auto;
        transition: border-color 0.3s ease;
    }
    
    .registration-form:hover {
        border-color: #999; /* Darker border on hover */
    }
    
    .registration-form h2 {
        font-size: 30px;
        font-weight: 600;
        color: #222;
        text-align: center;
        margin-bottom: 30px;
    }
    
    /* Label Styling */
    label {
        font-size: 14px;
        color: #555;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
    }
    
    /* Input and Select Fields */
    .form-control,
    .form-select {
        width: 100%;
        padding: 12px 15px;
        font-size: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.3s, box-shadow 0.3s;
        color: #555;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        outline: none;
    }
    
    /* Input Group for Country Code and Phone Number */
    .input-group {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .input-group .form-select {
        flex: 0 0 150px;
        margin-right: 10px;
        background-color: #f8f9fa;
    }
    
    .phone {
        flex: 1;
    }
    
    /* Refresh Icon Styling */
    #refreshIcon {
        cursor: pointer;
        width: 25px;
        margin-left: 10px;
        transition: transform 0.5s ease-in-out;
    }
    
    #refreshIcon:hover {
        opacity: 0.8;
    }
    
    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: #fff;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        width: 100%;
        transition: background-color 0.3s, transform 0.3s;
        margin-top: 20px;
    }
    
    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    
    /* Alert Messages */
    .alert {
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .registration-form {
            padding: 20px;
            margin: 20px;
        }
        
        .btn-primary {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
    
    /* Rotation Animation for Refresh Icon */
    @keyframes rotateClockwise {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .rotate-clockwise {
        animation: rotateClockwise 0.5s ease-in-out;
    }
</style>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="text-center">Signup Now</h2>
                <!-- Display Success or Error Messages -->
                <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <!-- Registration Form -->
                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                    <!-- Full Name and Email Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="fullName">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter your full name" required>                            
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
                        <div class="col-sm-6 mb-3">
                            <label id="Ctext" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter your email" required>                            
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
                    </div>
                      <div class="row g-3">
                    <!-- Phone Number Field Covering Full Line -->
                    <div class="form-auto mb-1">
                        <div class="input-group" style="margin-bottom: -10px;">
                            <!-- Country Code Dropdown -->
                            <select class="form-select p-1" name="country_code" id="country_code" required style="max-width: 150px;">
                                <?php echo $__env->make('partials.countryphonecode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <!-- Add more country codes as needed -->
                            </select>
                            <!-- Phone Number Input -->
                            <input type="number" class="form-control phone" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="Enter your phone number" required maxlength="10">
                        </div>
                        <label for="phone"></label>
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
                    </div>

                    <!-- Password and Password Confirmation Fields on the Same Line -->
                    <div class="row g-3">
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            
                            <?php $__errorArgs = ['password'];
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
                        <div class="col-md-6 form-auto mb-1">
                            <label id="Ctext" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            
                            <div id="passwordmsgid" style="display:none;">
                                <div class="text-danger">Password do not match</div>
                                <!-- <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger">Password do not match</div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> -->
                            </div>
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="form-auto mb-3">
                         <label id="Ctext" for="category">Join as</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->category_name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                       
                        <?php $__errorArgs = ['category'];
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

                    <div class="form-group mb-3">
                        <label for="captcha">Enter the text shown in the image:</label>
                        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter CAPTCHA" required>
                        <br>
                        <img id="captchaImage" src="<?php echo e(url('/captcha')); ?>" alt="CAPTCHA Image">
                        <img src="<?php echo e(asset('img/refresh.png')); ?>" id="refreshIcon" alt="Refresh CAPTCHA" style="cursor: pointer; width:25px; margin-left:10px;" onclick="refreshCaptcha()">

                        <?php $__errorArgs = ['captcha'];
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

                    <!-- Terms and Conditions Checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms">
                            By clicking to register, I agree to the <a href="<?php echo e(route('terms')); ?>">Terms of Use</a> and <a href="<?php echo e(route('privacy-policy')); ?>">Privacy Policy</a>.
                        </label>
                        <?php $__errorArgs = ['terms'];
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

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Register</button>
                </form>

                <!-- Already have an account -->
                <h3 class="text-center mt-4">Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a></h3>
            </div>
        </div>
    </div>
</div>


<script>
    function refreshCaptcha() {
        // Refresh the CAPTCHA image by appending a random query string to avoid caching
        var captchaImage = document.getElementById('captchaImage');
        captchaImage.src = '<?php echo e(url('/captcha')); ?>?' + Math.random();

        // Get the refresh icon and add the rotation class to trigger the animation
        var refreshIcon = document.getElementById('refreshIcon');

        // Remove the class if it's already there, then force a reflow before adding it again.
        refreshIcon.classList.remove('rotate-clockwise');
        void refreshIcon.offsetWidth; // This forces reflow, so the animation will re-trigger
        refreshIcon.classList.add('rotate-clockwise');
    }
     let passwordinput = document.getElementById("password");
     let confirmpasswordinput = document.getElementById("password_confirmation");
     let passwordmsgdiv = document.getElementById("passwordmsgid");

      function confirmpassword() {
        if(passwordinput.value !== confirmpasswordinput.value){
            passwordmsgdiv.style.display = "block";
            confirmpasswordinput.style.borderColor = "red";
        }
        else{
            passwordmsgdiv.style.display = "none";
            confirmpasswordinput.style.borderColor = "";
        }
     }

    //  passwordinput.addEventListener("input", confirmpassword);
     confirmpasswordinput.addEventListener("input", confirmpassword);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/register.blade.php ENDPATH**/ ?>