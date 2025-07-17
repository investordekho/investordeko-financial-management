<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h2>Guidance Needed for Investee</h2>
        <p>You have received a new request for guidance from an investee.</p>
        <p><strong>Investee Name:</strong> <?php echo e($name ?? 'N/A'); ?> </p>
        <p><strong>Investee Email:</strong> <?php echo e($email ?? 'N/A'); ?></p>
        <p><strong>Investee Contact Number:</strong> <?php echo e($phone ?? 'N/A'); ?></p>
        <p><strong>Concerned Person Name:</strong> <?php echo e($concern_person_name ?? 'N/A'); ?></p>
        <p><strong>Concerned Person Email:</strong> <?php echo e($concern_person_email ?? 'N/A'); ?></p>
        <p><strong>Concerned Person Contact Number:</strong> <?php echo e($concern_person_phone ?? 'N/A'); ?></p>
        <p><strong>Concerned Person Designation:</strong> <?php echo e($concern_person_designation ?? 'N/A'); ?></p>
        <p><strong>Company Name:</strong> <?php echo e($company_name ?? 'N/A'); ?></p>
        <p><strong>Company Website URL:</strong> <?php echo e($company_website ?? 'N/A'); ?></p>
        <p><strong>Investee ID:</strong> <?php echo e($user_id  ?? 'N/A'); ?></p>
        <p><strong>Guidance Topic:</strong> <?php echo e($guidance_needed ?? 'N/A'); ?></p>
        <div>
            <p>If you did not expect this message or if you believe this is an error, please ignore it.</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/auth/mailcreation/guidanceneededinvesteemail.blade.php ENDPATH**/ ?>