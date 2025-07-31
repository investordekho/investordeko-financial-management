<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h1 class="text-center mb-5 display-6 fw-bold">Order Confirmation</h1>

    <!-- Plan & Amount -->
    <div class="text-center mb-5">
        <p class="fs-5 mb-2">
          
        <?php
            if (Auth::user()->category_id == 1) {
                $category = 'You are about to subscribe to the investor data :';
            } elseif (Auth::user()->category_id == 2) {
                $category = 'You are about to subscribe to the investee data :';
            } else {
                $category = 'You are about to subscribe to the investee and investor data :';
            }
        ?>
          
            <strong class="text-dark"><?php echo e($category); ?></strong>
            <span class="text-muted"><?php echo e($plan); ?></span>
        </p>
        <p class="fs-5">
            <strong class="text-dark">Amount:</strong>
            <span class="text-muted"><?php echo e($totalprice); ?></span>
        </p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Bank Transfer Option -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <h4 class="text-primary fw-semibold mb-4">Bank Transfer</h4>
                    <div class="text-start mx-auto" style="max-width: 300px;">
                        <p><strong>Account Number:</strong> <span class="text-muted">250080071988</span></p>
                        <p><strong>IFSC Code:</strong> <span class="text-muted">INDB0000018</span></p>
                        <p><strong>Account Holder:</strong> <span class="text-muted">JaiBharti Investor Insights Pvt. Ltd.</span></p>
                        <p><strong>Bank Name:</strong> <span class="text-muted">Induslnd Bank</span></p>
                        <p><strong>Branch:</strong> <span class="text-muted">Andheri East</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Code / UPI Option -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <h4 class="text-primary fw-semibold mb-4">QR Code / UPI</h4>
                    <p class="text-muted mb-4">Scan the QR code below to make the payment</p>
                    <img src="<?php echo e(asset('img/payment.jpeg')); ?>" alt="QR Code" class="img-fluid rounded-3 border" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="text-center mb-5">
        <p class="text-muted mb-1">Please make the payment using one of the above options, then enter your details and confirm the payment.</p>
        <p class="text-muted">Once the payment is confirmed, access will be granted within 24 hours.</p>
    </div>

    <!-- User Info & Confirmation -->
    <div class="card shadow-sm border-0 rounded-4 mx-auto p-4" style="max-width: 600px;">
        <h5 class="text-primary fw-semibold mb-3 text-center">Confirm Your Payment</h5>
        <p class="text-muted text-center mb-4">Please provide the details from which you made the payment</p>
        <form action="<?php echo e(route('createsubscriptionrequest')); ?>" method="POST" enctype="multipart/form-data" id="payment_detail">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="no_of_data" value="<?php echo e($plan); ?>">
            <input type="hidden" name="plan_amount" value="<?php echo e($totalprice); ?>">
            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment_method" class="form-select" id="payment_method" required>
                    <option value="">Select...</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="upi">UPI / QR</option>
                </select>
            </div>
            <div class="mb-3" id="transaction_id_div">
                <label for="transaction_id" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transaction_id" name="transaction_id" required placeholder="Enter Transaction ID or UTR">
            </div>
            <div class="mb-3" id="reference_id_div" style="display: none;">
                <label for="reference_id" class="form-label">Reference ID</label>
                <input type="text" class="form-control" id="reference_id" name="reference_id" required placeholder="Enter Reference Id or UTR">
            </div>
            <div class="mb-3" id="upi_id_div" style="display: none;">
                <label for="amount" class="form-label">UPI ID</label>
                <input type="text" class="form-control" id="upi_id" name="upi_id" placeholder="Enter UPI Id">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number Used for Payment</label>
                <input type="tel" class="form-control" id="phone" name="phone" required placeholder="e.g. +91 9876543210"   pattern="^\+\d{10,18}$" maxlength=19 oninput="this.value = this.value.replace(/[^0-9+]/g, '')">
            </div>
            <div class="mb-3">
                <label for="screenshot" class="form-label">Upload Screenshot</label>
                <input type="file" class="form-control" id="screenshot" name="screenshot" accept="image/*" required>
            </div>           
            <div class="d-grid">
                <button type="submit" class="btn btn-primary rounded-pill py-2 shadow-sm" id="submitbutton">
                    Confirm Payment & Request For the Access
                </button>
            </div>  
        </form>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

    </div>

   
</div>
<script>
    //still all requred fields not filled submit button will be disabled
    document.addEventListener('DOMContentLoaded', function(){
        const form = document.getElementById('payment_detail');
        const submitButton = document.getElementById('submitbutton');
        submitButton.disabled = true;
        
        const submitbuttonvisiblity = () => { 
            let allFilled = true;
            const inputs = form.querySelectorAll('input[required], select[required]');
            inputs.forEach(input => {
                if(input.offsetParent === null){
                    return;
                }
                if(!input.value.trim()){
                    allFilled = false;
                }
            });
      
        
            submitButton.disabled = !allFilled;
            if(!allFilled){
                submitButton.classList.add('blur');
            }
            else{
                submitButton.disabled = false;
                submitButton.classList.remove('blur');
            }
        }
        form.addEventListener('input', submitbuttonvisiblity);
        form.addEventListener('change', submitbuttonvisiblity);
    });
</script>
<script>
    const paymentmethod = document.getElementById('payment_method');

    paymentmethod.addEventListener('change', function(){
        if(paymentmethod.value === 'bank'){
            document.getElementById('upi_id_div').style.display = 'none';
            document.getElementById('reference_id_div').style.display = 'block';
            document.getElementById('upi_id').required = false;
            document.getElementById('reference_id').required = true;
        }else if(paymentmethod.value === 'upi'){
            document.getElementById('upi_id_div').style.display = 'block';
            document.getElementById('reference_id_div').style.display = 'none';
            document.getElementById('upi_id').required = true;
            document.getElementById('reference_id').required = false;
        }
        
    })
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('payment_detail');
        const submitButton = document.getElementById('submitbutton');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent immediate form submission
            
            // Show popup
            //set timeout to show the alert after 1 second
            setTimeout(function() {
                alert('🎉 Congratulations! Your request has been submitted.');
            }, 1000);
            // alert('🎉 Congratulations! Your request has been submitted.');

            // After the alert closes, actually submit the form 
            form.submit();
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/payment/paymentcredentials.blade.php ENDPATH**/ ?>