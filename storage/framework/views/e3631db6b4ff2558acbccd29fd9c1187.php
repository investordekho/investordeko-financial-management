<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Dashboard</h1>

    <!-- Search Form -->
    <form method="GET" action="<?php echo e(route('dashboard.show')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo e(request('search')); ?>">
            <select name="user_type" class="form-select">
                <option value="investee" <?php echo e(request('user_type') == 'investee' ? 'selected' : ''); ?>>Investees</option>
                <option value="investor" <?php echo e(request('user_type') == 'investor' ? 'selected' : ''); ?>>Investors</option>
                <option value="banker" <?php echo e(request('user_type') == 'banker' ? 'selected' : ''); ?>>Bankers</option>
            </select>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Display Search Results -->
    <?php if($results->isEmpty()): ?>
        <p>No results found for "<?php echo e($searchQuery); ?>".</p>
    <?php else: ?>
        <h3>Search Results:</h3>
        <ul class="list-group">
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <strong><?php echo e($result->name); ?></strong><br>
                    <!-- Additional details based on user type -->
                    <?php if($userType == 'investee'): ?>
                        Sector: <?php echo e($result->sector); ?>

                    <?php elseif($userType == 'investor'): ?>
                        Investment Focus: <?php echo e($result->investment_focus); ?>

                    <?php elseif($userType == 'banker'): ?>
                        Field of Specialization: <?php echo e($result->field_of_specialization); ?>

                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views\dashboard.blade.php ENDPATH**/ ?>