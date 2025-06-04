<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger shadow-sm">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger shadow-sm">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<style>
    .required::after {
        content: " *";
        color: red;
    }

    .form-section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 0.75rem;
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }

    #labelinput {
        font-weight: 500;
        font-size: 0.9rem;
    }

    .form-check-label {
        font-size: 0.85rem;
    }

    .spaced-input {
        font-size: 0.875rem;
    }
</style>

<div class="container">
    <!-- Title Section -->
    <div class="row mt-3">
        <div class="col-md-12 text-center bg-primary text-white p-3 rounded-top shadow-sm">
            <h2 class="mb-1" style="font-size: 1.25rem; font-weight: 600;">Submit Your Contact Information</h2>
            <p style="font-size: 0.85rem;">Please fill in your details to help us better understand your needs.</p>
            <div style="width: 40px; height: 2px; background-color: white; margin: 0 auto;"></div>
        </div>
    </div>

    <!-- Form Section -->
    <form id="othersForm" action="<?php echo e(route('form.other.submit')); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-bottom shadow-sm mt-0">
        <?php echo csrf_field(); ?>

        <!-- Contact Details -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="form-section-title">Contact Details</div>
                <!-- <div class="form-check" style="text-align: left;">
                    <input type="checkbox" class="form-check-input" id="concerned_person_is_me" onclick="fillConcernedPersonDetails()">
                    <label class="form-check-label text-danger" for="concerned_person_is_me">Concerned Person is Me</label>
                </div> -->
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <!-- <div class="form-section-title">Contact Details</div> -->
                <div class="form-check" style="text-align: left;">
                    <input type="checkbox" class="form-check-input" id="concerned_person_is_me" name="concerned_person_is_me" onclick="fillConcernedPersonDetails()"   value="1" <?php echo e(old('concerned_person_is_me') ? 'checked': ''); ?>>
                    <label class="form-check-label text-danger" for="concerned_person_is_me">Concerned Person is Me</label>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label id="labelinput" for="full_name" class="required">Full Name</label>
                    <input type="text" class="form-control spaced-input" id="full_name" name="full_name" value="<?php echo e(old('full_name')); ?>" required>
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="email" class="required">Email</label>
                    <input type="email" class="form-control spaced-input" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="phone_number" class="required">Phone Number</label>
                    <input type="text" class="form-control spaced-input" id="phone_number" name="phone_number" maxlength="20" value="<?php echo e(old('phone_number')); ?>"   pattern="^\+?[0-9]{7,20}$" 
                oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" required>
                </div>
            </div>
        </div>

        <!-- Address Section -->
        <div class="mb-4">
            <div class="form-section-title">Address Details</div>
            <div class="mb-3">
                <label id="labelinput" for="address" class="required">Address</label>
                <input type="text" class="form-control spaced-input" id="address" name="address" value="<?php echo e(old('address')); ?>" required>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label id="labelinput" for="city" class="required">City</label>
                    <input type="text" class="form-control spaced-input" id="city" name="city" value="<?php echo e(old('city')); ?>" required>
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="state" class="required">State</label>
                    <input type="text" class="form-control spaced-input" id="state" name="state" value="<?php echo e(old('state')); ?>" required>
                </div>
                <div class="col-md-4">
                    <label id="labelinput" for="country" class="required">Country</label>
                    <input type="text" class="form-control spaced-input" id="country" name="country" value="<?php echo e(old('country')); ?>" required>
                </div>
            </div>
        </div>

        <!-- Referral Section -->
        <div class="mb-4">
            <div class="form-section-title">How did you hear about Investor Dekho?</div>
            <div class="form-floating">
                <select class="form-select spaced-input" id="referral_source" name="referral_source" required>
                    <option value="" disabled <?php echo e(old('referral_source') ? '' : 'selected'); ?>>Select Source</option>
                    <option value="Friend/Family" <?php echo e(old('referral_source') == 'Friend/Family' ? 'selected' : ''); ?>>Friend/Family</option>
                    <option value="Social Media (Facebook, Instagram, Twitter, etc.)" <?php echo e(old('referral_source') == 'Social Media (Facebook, Instagram, Twitter, etc.)' ? 'selected' : ''); ?>>Social Media</option>
                    <option value="Online Search (Google, Bing, etc.)" <?php echo e(old('referral_source') == 'Online Search (Google, Bing, etc.)' ? 'selected' : ''); ?>>Online Search</option>
                    <option value="Advertisement (TV, Radio, Print)" <?php echo e(old('referral_source') == 'Advertisement (TV, Radio, Print)' ? 'selected' : ''); ?>>Advertisement</option>
                    <option value="Email Newsletter" <?php echo e(old('referral_source') == 'Email Newsletter' ? 'selected' : ''); ?>>Email Newsletter</option>
                    <option value="Event/Seminar" <?php echo e(old('referral_source') == 'Event/Seminar' ? 'selected' : ''); ?>>Event/Seminar</option>
                    <option value="Professional Referral (Doctor, Lawyer, etc.)" <?php echo e(old('referral_source') == 'Professional Referral (Doctor, Lawyer, etc.)' ? 'selected' : ''); ?>>Professional Referral</option>
                    <option value="Blog/Website" <?php echo e(old('referral_source') == 'Blog/Website' ? 'selected' : ''); ?>>Blog/Website</option>
                    <option value="Direct Mail" <?php echo e(old('referral_source') == 'Direct Mail' ? 'selected' : ''); ?>>Direct Mail</option>
                    <option value="Company Website" <?php echo e(old('referral_source') == 'Company Website' ? 'selected' : ''); ?>>Company Website</option>
                </select>
                <label for="referral_source">Referral Source</label>
            </div>
        </div>

        <!-- Terms Section -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" required>
            <label class="form-check-label" for="terms">I agree to the <a href="<?php echo e(route('terms')); ?>" target="_blank">Terms and Conditions</a></label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 py-2">Submit</button>
    </form>
</div>

<script>
    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('full_name');
        const phoneField = document.getElementById('phone_number');
        const emailField = document.getElementById('email');

        if (document.getElementById('concerned_person_is_me').checked) {
            nameField.value = "<?php echo e(Auth::user()->name); ?>";
            phoneField.value = "<?php echo e(Auth::user()->phone); ?>";
            emailField.value = "<?php echo e(Auth::user()->email); ?>";

            nameField.readOnly = true;
            phoneField.readOnly = true;
            emailField.readOnly = true;
        } else {
            nameField.value = '';
            phoneField.value = '';
            emailField.value = '';

            nameField.readOnly = false;
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    }

     document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('concerned_person_is_me').checked) {
            fillConcernedPersonDetails();
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/forms/other_form.blade.php ENDPATH**/ ?>