<?php if($investees->count()): ?>
    <?php
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvesteeCount = $isSubscribed ? $investees->count() : min($investees->count(), 3);
    ?>

    <?php $__currentLoopData = $investees->take($visibleInvesteeCount); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 mb-4">
            <div class="investee-card p-4">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div class="profile-wrapper">
                            <img src="<?php echo e($investee->profile_image ? asset('storage/profile_image/' . $investee->profile_image) : asset('img/default_profile.png')); ?>" 
                                 class="profile-img" 
                                 alt="Investee Logo">
                            <span class="badge premium-badge">⭐ Premium</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="fw-bold name-text <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                            <?php echo e($investee->company_name ?? 'Unknown User'); ?>

                        </h4> 
                        <p class="text-muted details-text <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                            <i class="bi bi-geo-alt-fill text-primary"></i> <?php echo e($investee->address); ?>  
                            &nbsp;|&nbsp;
                            <i class="bi bi-person-badge text-success"></i> 
                            Founded by <?php echo e($investee->founders->first()->name ?? 'N/A'); ?>

                        </p>
                    </div>

                    <div class="col-md-4 text-end">
                        <a href="<?php echo e(route('investordashboard.investeelistdetail', ['id' => $investee->id])); ?>" 
                        class="btn btn-primary btn-sm">🔍 View Profile</a>
                    </div>

                </div>

                <hr class="divider">

                <div class="row text-center">
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-briefcase-fill text-info"></i> Business Type</p>
                        <p class="info-value <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>"><?php echo e($investee->nature_of_business ?? 'N/A'); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-calendar-event text-warning"></i> Incorporated</p>
                        <p class="info-value <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>"><?php echo e($investee->incorporated_in ?? 'N/A'); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class="info-label"><i class="bi bi-cash-stack text-success"></i> Fund Usage</p>
                        <p class="info-value <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>"><?php echo e($investee->fundRequirements->first()->usage ?? 'N/A'); ?></p>
                    </div>
                </div>

                <hr class="divider">

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="fw-bold"><i class="bi bi-graph-up text-primary"></i> Previous Investments</h5>
                        <?php if($investee->previousRounds->count()): ?>
                            <?php $__currentLoopData = $investee->previousRounds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $round): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p class="investment-details <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                                    <strong>Round:</strong> <?php echo e($round->round); ?>  
                                    &nbsp;|&nbsp;
                                    <strong>Investors:</strong> <?php echo e($round->investors); ?>  
                                    &nbsp;|&nbsp;
                                    <strong>Amount Raised:</strong> ₹<?php echo e(number_format($round->amount_raised, 2)); ?> Cr  
                                    &nbsp;|&nbsp;
                                    <strong>Valuation:</strong> ₹<?php echo e(number_format($round->valuation, 2)); ?> Cr
                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <p class="text-muted">No previous investments found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(!$isSubscribed && $investees->count() == 3): ?>
        <div class="col-md-12 text-center mt-4">
            <div class="alert subscription-box">
                <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
                <p>Subscribe now to view complete details and get unlimited access to all investees on this platform.</p>
                <a href="<?php echo e(route('subscription')); ?>" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
            </div>
        </div>
    <?php endif; ?>

    
<?php else: ?>
    <div class="container mt-5 <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
        <h2 class="text-center mb-4 fw-bold text-dark">No Investees Found</h2>
        <p class="text-center">Please check back later or consider subscribing for more options.</p>
    </div>
<?php endif; ?>

<style>
    .investee-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .investee-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .profile-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .profile-img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid #ddd;
    }
    
    .premium-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        background: gold;
        color: black;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: bold;
    }

    .locked-content {
        filter: blur(3px);
        opacity: 0.6;
    }
    
    .subscription-box {
        background: #fffae6;
        padding: 20px;
        border-radius: 12px;
        transition: 0.3s;
    }

    .subscription-box:hover {
        background: #ffe5b4;
    }
</style>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/partials/investee_list.blade.php ENDPATH**/ ?>