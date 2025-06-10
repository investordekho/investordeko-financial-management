<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Dashboard</h1>

        <!-- Display search query and type if provided -->
        <?php if(session('search_query') && session('user_type')): ?>
            <p>Showing results for <strong><?php echo e(session('search_query')); ?></strong> as <strong><?php echo e(session('user_type')); ?></strong></p>
            <!-- Display relevant search results here based on user type -->
        <?php else: ?>
            <p>Welcome to the Dashboard!</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views\dashboards\dashboard.blade.php ENDPATH**/ ?>