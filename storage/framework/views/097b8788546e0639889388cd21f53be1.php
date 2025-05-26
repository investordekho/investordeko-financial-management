<!DOCTYPE html>
<html>
<head>
    <title>Support Query</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 20px;
        }
        .label {
            font-weight: bold;
        }
        .value {
            margin-left: 10px;
        }
        .message-content {
            white-space: pre-wrap;
            background: #f9f9f9;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Support Request Details</h2>
        <p><span class="label">Name:</span> <span class="value"><?php echo e($name ?? 'N/A'); ?></span></p>
<p><span class="label">Email:</span> <span class="value"><?php echo e($email ?? 'N/A'); ?></span></p>
<p><span class="label">Phone:</span> <span class="value"><?php echo e($phone ?? 'N/A'); ?></span></p>
<p><span class="label">Issue Type:</span> <span class="value"><?php echo e($issueType ?? 'N/A'); ?></span></p>
<p><span class="label">Message:</span></p>
<div class="message-content"><?php echo e($usermessage ?? 'N/A'); ?></div>

    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/mailcreation/supportforsubscription.blade.php ENDPATH**/ ?>