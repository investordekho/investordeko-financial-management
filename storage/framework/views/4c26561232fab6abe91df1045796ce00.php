<!-- resources/views/layouts/app.blade.php -->
<?php echo $__env->make('includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Main Content -->
<div class="content">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<?php echo $__env->make('includes.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/layouts/app.blade.php ENDPATH**/ ?>