<?php $__env->startSection('content'); ?>

<div class="container-xl py-5 px-2">
    <div class="row justify-content-center">
        <div class="col-12">

<!-- Page Header -->
<div style="text-align: center; margin-bottom: 40px;">
    
    <!-- Label -->
    <div style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 16px;
                background-color: #f3f6ff; color: #1a73e8; font-size: 14px; font-weight: 600;
                border-radius: 999px; border: 1px solid #d6e2ff;">
        <i class="bi bi-bar-chart-steps" style="font-size: 16px;"></i>
        <span>Subscription Requests</span>
    </div>

    <!-- Heading -->
    <h1 style="margin-top: 16px; font-size: 28px; font-weight: 700; color: #1f1f1f;">
        All Subscription Requests
    </h1>

</div>






            <!-- Flash Messages -->
            <?php $__currentLoopData = ['success', 'error', 'successMessage', 'errorMessage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(session($msg)): ?>
                    <div class="alert alert-<?php echo e(str_contains($msg, 'error') ? 'danger' : 'success'); ?> alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
                        <i class="bi <?php echo e(str_contains($msg, 'error') ? 'bi-x-circle' : 'bi-check-circle'); ?> me-2"></i>
                        <?php echo e(session($msg)); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Total Subscription Requests Count -->
            <div class="text-start mb-4">
                <p class="border border-primary text-primary fw-semibold py-1 px-4 d-inline-block rounded-3 shadow-sm" style="background-color: #f0f4ff;">
                    <span class="fw-semibold">Total Subscription Requests: </span>
                    <span class="fw-bold text-dark"><?php echo e($subscriptionRequests->count()); ?></span>
                </p>
            </div>


            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-hover align-middle mb-0" style="font-size: 0.85rem;">
                        <thead class="text-white fw-semibold" style="background: linear-gradient(90deg, #466B90, #4A6A8C);">
                            <tr class="text-center">
                                <th class="py-3 px-3">ID</th>
                                <th class="py-3 px-3">User</th>
                                <th class="py-3 px-3">Contact</th>
                                <th class="py-3 px-3">Plan</th>
                                <th class="py-3 px-3">Data</th>
                                <th class="py-3 px-3">Status</th>
                                <th class="py-3 px-3">Method</th>
                                <th class="py-3 px-3">Screenshot</th>
                                <th class="py-3 px-3">Amount</th>
                                <th class="py-3 px-3">Txn ID</th>
                                <th class="py-3 px-3">Ref ID</th>
                                <th class="py-3 px-3">Phone</th>
                                <th class="py-3 px-3">Date</th>
                                <th class="py-3 px-3">Period</th>
                                <th class="py-3 px-3">Plan ₹</th>
                            </tr>
                        </thead>
                        <tbody class="text-muted">
                            <?php $__empty_1 = true; $__currentLoopData = $subscriptionRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover-bg-light">
                                <td class="text-center px-3 py-2"><?php echo e($request->id); ?></td>
                                <td class="px-3 py-2"><?php echo e($request->user->name ?? 'Guest'); ?></td>
                                <td class="px-3 py-2"><?php echo e($request->user->phone ?? 'N/A'); ?></td>
                                <td class="text-center px-3 py-2"><?php echo e($request->plan); ?></td>
                                <td class="text-center px-3 py-2"><?php echo e($request->no_of_data); ?></td>

                                <!-- Status Dropdown -->
                                <td class="text-center px-3 py-2">
                                    <form action="<?php echo e(route('subscriptionrequest.updatestatus', $request->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <select name="status" class="form-select form-select-sm rounded-pill px-2" onchange="this.form.submit()" style="min-width: 100px;">
                                            <option value="pending" <?php echo e($request->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="approved" <?php echo e($request->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                            <option value="rejected" <?php echo e($request->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                        </select>
                                    </form>
                                </td>

                                <td class="text-center px-3 py-2"><?php echo e($request->paymentdetail->payment_method ?? 'N/A'); ?></td>

                                <td class="text-center px-3 py-2">
                                    <?php if(!empty($request->paymentdetail->screen_shot)): ?>
                                    <img src="<?php echo e(asset('storage/' . $request->paymentdetail->screen_shot)); ?>" alt="Screenshot" class="img-fluid rounded shadow-sm" width="90" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to view full-size image">
                                    <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center px-3 py-2">
                                    <?php echo e($request->paymentdetail->amount ?? 'N/A'); ?>

                                    <?php echo e($request->paymentdetail->currency ?? ''); ?>

                                </td>

                                <td class="text-center px-3 py-2"><?php echo e($request->paymentdetail->transaction_id ?? 'N/A'); ?></td>
                                <td class="text-center px-3 py-2"><?php echo e($request->paymentdetail->reference_id ?? 'N/A'); ?></td>
                                <td class="text-center px-3 py-2"><?php echo e($request->paymentdetail->phone ?? 'N/A'); ?></td>

                                <td class="text-center px-3 py-2">
                                    <?php echo e($request->paymentdetail ? \Carbon\Carbon::parse($request->paymentdetail->created_at)->format('d M Y, h:i A') : 'N/A'); ?>

                                </td>

                                <td class="text-center px-3 py-2"><?php echo e($request->subscription_start ?? '-'); ?> to <?php echo e($request->subscription_end ?? '-'); ?></td>

                                <td class="text-center px-3 py-2"><?php echo e($request->plan_amount ?? 'N/A'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="15" class="text-center text-muted py-4">No subscription requests found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>


<!-- Include Bootstrap JS and Popper.js for Tooltips -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    //want pop up image when hover on image 
    var imgtooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"] img'))
    imgtooltipTriggerList.forEach(function (imgEl) {
        imgEl.addEventListener('mouseover', function () {
            var fullSizeImg = document.createElement('img');
            fullSizeImg.src = imgEl.src;
            fullSizeImg.style.position = 'absolute';
            fullSizeImg.style.zIndex = '9999';
            fullSizeImg.style.width = '300px';
            fullSizeImg.style.height = 'auto';
            fullSizeImg.style.top = '50%';
            fullSizeImg.style.left = (imgEl.getBoundingClientRect().left + window.scrollX + imgEl.offsetWidth / 2) + 'px';
            fullSizeImg.style.transform = 'translate(-50%, -50%)';
            document.body.appendChild(fullSizeImg);
    
            imgEl.addEventListener('mouseout', function () {
                document.body.removeChild(fullSizeImg);
            }, { once: true });
        });
    });
    
</script>



            <!-- Optional Debug Output -->
            <script>
                console.log('Subscription Requests:', <?php echo json_encode($subscriptionRequests); ?>);
            </script>

        </div>
    </div>
</div>

<!-- Inline JavaScript for Hover Effect -->
<script>
    const headerElement = document.querySelector('.d-inline-flex');
    headerElement.addEventListener('mouseover', function() {
        this.style.backgroundColor = 'rgba(0, 123, 255, 0.1)';
        this.style.transform = 'translateY(-4px)';
    });
    headerElement.addEventListener('mouseout', function() {
        this.style.backgroundColor = 'rgba(255, 255, 255, 0.85)';
        this.style.transform = 'translateY(0)';
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/allsubscriptionrequests.blade.php ENDPATH**/ ?>