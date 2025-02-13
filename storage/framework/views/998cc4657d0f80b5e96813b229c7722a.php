<!-- resources/views/layouts/app.blade.php -->
<?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main Content -->
<div class="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\laravel_data\resources\views/layouts/app.blade.php ENDPATH**/ ?>