

<?php $__env->startSection('content'); ?>

<div class="container-xxl py-5">
    <div class="row justify-content-center">
        <div class="col-12">

            <!-- Page Header -->
            <div class="text-center mb-5">
                <p class="d-inline-block border border-primary rounded-pill text-primary fw-semibold py-1 px-3 mb-2">
                    Subscription Requests
                </p>
                <h1 class="display-6">All Subscription Requests</h1>
            </div>

            <!-- Flash Messages -->
            <?php $__currentLoopData = ['success', 'error', 'successMessage', 'errorMessage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(session($msg)): ?>
                    <div class="alert alert-<?php echo e(str_contains($msg, 'error') ? 'danger' : 'success'); ?> alert-dismissible fade show" role="alert">
                        <?php echo e(session($msg)); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Main Table Card -->
            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-body table-responsive">
                    <table class="table table-striped align-middle table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="padding: 15px; width: 5%;">ID</th>
                                <th style="padding: 15px; width: 15%;">User</th>
                                <th style="padding: 15px; width: 10%;">Login User Contact</th>
                                <th style="padding: 15px; width: 10%;">Plan</th>
                                <th style="padding: 15px; width: 10%;">Data Count</th>
                                <th style="padding: 15px; min-width: 150px; width: 50%;">Status</th> <!-- Adjusted width for Status -->
                                <th style="padding: 15px; width: 10%;">Payment Method</th>
                                <th style="padding: 15px; width: 15%;">Screenshot</th>
                                <th style="padding: 15px; width: 10%;">Amount Paid</th>
                                <th style="padding: 15px; width: 10%;">Transaction ID</th>
                                <th style="padding: 15px; width: 10%;">Reference ID</th>
                                <th style="padding: 15px; width: 10%;">Phone</th>
                                <th style="padding: 15px; width: 15%;">Payment Date</th>
                                <th style="padding: 15px; width: 15%;">Subscription Period</th>
                                <th style="padding: 15px; width: 10%;">Plan Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $subscriptionRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td style="padding: 15px;"><?php echo e($request->id); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->user->name ?? 'Guest'); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->user->phone ?? 'N/A'); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->plan); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->no_of_data); ?></td>

                                <!-- Status Dropdown -->
                                <td style="padding: 15px;">
                                    <form action="<?php echo e(route('subscriptionrequest.updatestatus', $request->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <select name="status" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                                            <option value="pending" <?php echo e($request->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="approved" <?php echo e($request->status == 'approved' ? 'selected' : ''); ?>>Approved</option>
                                            <option value="rejected" <?php echo e($request->status == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                        </select>
                                    </form>
                                </td>

                                <!-- Payment Method -->
                                <td style="padding: 15px;"><?php echo e($request->paymentdetail->payment_method ?? 'N/A'); ?></td>

                                <!-- Screenshot -->
                                <td style="padding: 15px;">
                                    <?php if(!empty($request->paymentdetail->screen_shot)): ?>
                                    <img src="<?php echo e(asset('storage/' . $request->paymentdetail->screen_shot)); ?>" alt="Payment Screenshot" width="300">
                                    <?php else: ?>
                                        <span class="text-muted">Not Uploaded</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Payment Details with Null Check -->
                                <td style="padding: 15px;">
                                    <?php echo e($request->paymentdetail ? $request->paymentdetail->amount : 'N/A'); ?> 
                                    <?php echo e($request->paymentdetail ? $request->paymentdetail->currency : 'N/A'); ?>

                                </td>
                                <td style="padding: 15px;"><?php echo e($request->paymentdetail->transaction_id ?? 'N/A'); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->paymentdetail->reference_id ?? 'N/A'); ?></td>
                                <td style="padding: 15px;"><?php echo e($request->paymentdetail->phone ?? 'N/A'); ?></td>
                                <td style="padding: 15px;">
                                    <?php echo e($request->paymentdetail ? \Carbon\Carbon::parse($request->paymentdetail->created_at)->format('d M Y, h:i A') : 'N/A'); ?>

                                </td>

                                <!-- Subscription Period -->
                                <td style="padding: 15px;"><?php echo e($request->subscription_start ?? '-'); ?> to <?php echo e($request->subscription_end ?? '-'); ?></td>

                                <!-- Plan Amount -->
                                <td style="padding: 15px;"><?php echo e($request->plan_amount ?? 'N/A'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="14" class="text-center text-muted py-4">No subscription requests found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Optional Debug Output -->
            <script>
                console.log('Subscription Requests:', <?php echo json_encode($subscriptionRequests); ?>);
            </script>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/allsubscriptionrequests.blade.php ENDPATH**/ ?>