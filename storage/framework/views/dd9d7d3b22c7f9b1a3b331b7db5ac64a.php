<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Approved</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        
        <h2 style="color: #2c3e50;">Dear <?php echo e($userName); ?>,</h2>

        <p style="font-size: 16px;">We’re excited to let you know that your <strong>subscription request has been approved</strong>! 🎉</p>

        <h3 style="margin-top: 30px; color: #34495e;">📄 Subscription Details:</h3>
        <ul style="font-size: 16px; line-height: 1.6;">
            <li><strong>Plan:</strong> <?php echo e($planName); ?></li>
            <li><strong>Amount:</strong> ₹<?php echo e($planAmount); ?></li>
            <li><strong>Validity:</strong> <?php echo e($planValidity); ?></li>
        </ul>

        <p style="font-size: 16px;">Thank you for subscribing to our services. We look forward to serving you!</p>

        <p style="margin-top: 40px; font-size: 16px;">
            Warm regards,<br>
            <strong>The Investor Dekho Team</strong><br>
            <a href="https://investordekho.in" style="color: #3498db; text-decoration: none;">investordekho.in</a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/mailcreation/subscription_approved.blade.php ENDPATH**/ ?>