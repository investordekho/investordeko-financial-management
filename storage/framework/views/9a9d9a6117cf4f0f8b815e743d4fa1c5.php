<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Contact Request</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f9fb;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 500px;
            margin: 40px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        h1 {
            color: #2d3e50;
            font-size: 1.7rem;
            margin-bottom: 18px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
        }
        .info {
            margin-bottom: 18px;
        }
        .info p {
            margin: 8px 0;
            color: #444;
            font-size: 1.05rem;
        }
        .label {
            font-weight: 600;
            color: #2d3e50;
        }
        .note {
            background: #f1f5fa;
            border-left: 4px solid #4a90e2;
            padding: 10px 16px;
            margin: 18px 0 0 0;
            color: #2d3e50;
            font-size: 0.98rem;
        }
        .footer {
            margin-top: 28px;
            font-size: 0.93rem;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Service Contact</h1>   
        <p> You have received a new service contact request.</p>

        <div class="info">
           <p><span class="label">User Name:</span> <?php echo e($name); ?></p>
<p><span class="label">User Email:</span> <?php echo e($email); ?></p>
<p><span class="label">User Phone:</span> <?php echo e($phone); ?></p>
<p><span class="label">User Services:</span> <?php echo e(is_array($services) ? implode(', ', $services) : $services); ?></p>

        </div>
        <div class="note">
            <strong>Note:</strong> <?php echo e($note); ?>

        </div>
        <div class="footer">
            If you did not request this, please ignore this email.
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/mailcreation/servicecontactmail.blade.php ENDPATH**/ ?>