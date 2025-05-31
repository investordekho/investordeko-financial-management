<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Form Submission</h2>
        <p>Dear Admin,</p>
        <p>You have received a new contact form submission from your website.</p>
        <p>Here are the details:</p>
        <p><strong>Name:</strong> <?php echo e($name); ?></p>
        <p><strong>Phone:</strong> <?php echo e($phone); ?></p>
        <P><strong>Payment Method:</strong> <?php echo e($payment_method); ?></p>
        <p><strong>Transaction Id:</strong><?php echo e($transaction_id); ?></p>
        <p><strong>Reference Id:</strong> <?php echo e($reference_id); ?></p>
        <p><strong>Plan Amount:</strong>  ₹<?php echo e($plan_amount); ?></p>
        <p><strong>No Of Data:</strong> <?php echo e($no_of_data); ?></p>
      
        <br>
        <p>Login User all details are:</p>
        <p><strong>Name:</strong> <?php echo e(Auth::user()->name); ?></p>
        <p><strong>Email:</strong> <?php echo e(Auth::user()->email); ?></p>
        <p><strong>Phone:</strong> <?php echo e(Auth::user()->phone); ?></p>
        <p><strong>Company Name:</strong> 
            <?php if(Auth::user()->category_id == 1): ?>
            Investee
            <?php elseif(Auth::user()->category_id == 2): ?>
            Investor
            <?php elseif(Auth::user()->category_id == 3): ?>
            Investement Banker / Partner
            <?php else: ?>
            Other
            <?php endif; ?>
        </p>
          <p><strong>Our Price:</strong>
            <?php if($no_of_data <= 10): ?>
                ₹<?php echo e($no_of_data * 999); ?>

            <?php else: ?>
                ₹<?php echo e($no_of_data * 499); ?>

            <?php endif; ?>
        </p>

        
        <div class="footer">
            <p>If you did not expect this message, please ignore it.</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/mailcreation/subscriptionrequestmail.blade.php ENDPATH**/ ?>