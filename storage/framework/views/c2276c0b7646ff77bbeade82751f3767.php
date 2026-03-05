<!-- <?php 
    $isSubscribed = isset($subscriber) && $subscriber?->is_subscribed;
?>

<?php if($investors->count()): ?>
    <?php 
        $isSubscribed = $subscriber && $subscriber->is_subscribed;
        $visibleInvestorCount = $isSubscribed ? $investors->count() : min($investors->count(), 3);
    ?>
<style>
    .locked-content {
        filter: blur(5px);
        opacity: 0.6;
        user-select: none;
        pointer-events: none;
        cursor: not-allowed;
        
    }

</style>
<div class="container mt-5">
  

    <div class="row">
        <?php $__currentLoopData = $investors->take($visibleInvestorCount); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 mb-4">
                <div class="investor-card p-4">
                    <div class="row align-items-center">
                        
                        
                        <div class="col-md-2 text-center">
                            <div class="profile-wrapper">
                                <img src="<?php echo e($investor['profile_image'] ? asset('storage/profile_image/' . $investor['profile_image']) : asset('img/default_profile.png')); ?>" 
                                     class="profile-img" 
                                     alt="Investor Profile">
                                <span class="badge premium-badge">⭐ Premium</span>
                            </div>
                        </div>

                       
                        <div class="col-md-6">
                            <h4 class="fw-bold name-text <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                                <?php echo e($investor['investor_name'] ?? 'Unknown Investor'); ?>

                            </h4> 
                            <p class="text-muted details-text <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                                <i class="bi bi-geo-alt-fill text-primary me-1"></i> <?php echo e($investor['address']); ?>  
                                <br>

                                    <?php
                                        $sectors = str_replace([', and', 'and'],',', $investor['sectors_preferred']);    
                                        $sectors = array_map('trim', explode(',', $sectors));
                                    ?>
                                   
                                    <?php if( count($sectors) > 0): ?>
                                       <ul class="list-inline">
                                         <h7 class="text-muted">Sectors:</h7>
                                            <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-inline-item text-muted" style="border: 1px solid #ddd; padding: 5px; border-radius: 5px; margin-right: 5px; margin-bottom: 5px; background-color: #f8f9fa;">
                                                 
                                                    <?php echo e(ucwords(strtolower($sector))); ?>

                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                   
                            </p>


                        </div>

                        <div class="col-md-4 text-end <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
                            <?php if($isSubscribed): ?>
                                <a href="<?php echo e(route('investeedashboard.investorlistdetail',['id' => $investor['id']])); ?>" 
                                class="btn btn-primary btn-sm">🔍 View Details</a>
                            <?php else: ?>
                                <span class="btn btn-primary btn-sm disabled" style="cursor: not-allowed; pointer-events: none;">
                                    🔍 View Details
                                </span>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php else: ?>
    <div class="container mt-5 <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
        <h2 class="text-center mb-4 fw-bold text-dark">No Investors Found</h2>
        <p class="text-center">Please check back later or consider subscribing for more options.</p>
    </div>
    <div class="divider height-4"></div>
<?php endif; ?>
<div class="col-md-12 text-center mt-4">
            <div class="alert subscription-box">
                <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
                <p>Subscribe now to view complete details and get unlimited access to all investees on this platform.</p>
                <a href="<?php echo e(route('subscription')); ?>" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
            </div>
        </div>
         <div class="divider height-4"></div>
<style>
    .investor-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .investor-card:hover {
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

    .divider {
        border-top: 1px solid #e0e0e0;
        margin: 15px 0;
    }

    .info-label {
        font-size: 14px;
        font-weight: bold;
        color: #6c757d;
    }

    .info-value {
        font-size: 16px;
        color: #333;
    }
    
    .locked-content {
        filter: blur(5px);
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



























 -->
<!-- if (config('app.debug')) {
    if (isset($userAccess)) {
        echo '<pre style="background:#fffbe6;padding:10px;border:1px solid #ffdca8;color:#222;overflow:auto;">';
        echo 'userAccess:' . PHP_EOL . e(var_export($userAccess, true));
        echo '</pre>';
    } else {
        echo '<pre style="background:#fffbe6;padding:10px;border:1px solid #ffdca8;color:#222;">userAccess: (not set)</pre>';
    }
} -->
<?php 
    $isSubscribed = $subscriber?->is_subscribed ?? false;

    $approvedInvestors = [];
    $lockedInvestors = [];


    foreach($investors as $investor) {
        $approved = in_array($investor->id, $userAccess);

        if($approved) {
            $approvedInvestors[] = $investor;
        } else {
            $lockedInvestors[] = $investor;
           
        }
    }

    $sortedInvestors = array_merge($approvedInvestors, $lockedInvestors);
?>

<?php if($investors->count()): ?>
<style>
    .locked-content { 
        filter: blur(5px);
        opacity: 0.6;
        pointer-events: none;
        user-select: none;
        cursor: not-allowed;
        transition: all 0.3s ease-in-out;
    }
</style>

<?php if($showSubscribeMessage): ?>
<div class="col-md-12 text-center mt-4">
    <div class="alert subscription-box">
        <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
        <p>Subscribe now to view full details and get unlimited access to all search results.</p>
        <a href="<?php echo e(route('subscription')); ?>" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
    </div>
</div>
<?php endif; ?>
<div class="container mt-5">
    <div class="row">
        <?php $__currentLoopData = $sortedInvestors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $approved = in_array($investor->id, $userAccess);
                $blurClass = (!$approved || !$isSubscribed) ? 'locked-content' : '';
            ?>

            <div class="col-md-12 mb-4">
                <div class="investor-card p-4 <?php echo e($blurClass); ?>">
                    <div class="row align-items-center">
                        <!-- Profile Image -->
                        <div class="col-md-2 text-center">
                            <div class="profile-wrapper">
                                <img src="<?php echo e($investor->profile_image ? asset('storage/profile_image/' . $investor->profile_image) : asset('img/default_profile.png')); ?>" 
                                     class="profile-img" 
                                     alt="Investor Profile">
                                <span class="badge premium-badge">⭐ Premium</span>
                            </div>
                        </div>

                        <!-- Investor Info -->
                        <div class="col-md-6">
                            <h4 class="fw-bold name-text"><?php echo e($investor->investor_name ?? 'Unknown Investor'); ?></h4> 
                            <p class="text-muted details-text">
                                <i class="bi bi-geo-alt-fill text-primary me-1"></i> <?php echo e($investor->address); ?>  
                                <br>
                                <?php
                                    $sectors = str_replace([', and', 'and'],',', $investor->sectors_preferred ?? '');    
                                    $sectors = array_map('trim', explode(',', $sectors));
                                ?>
                                <?php if(count($sectors) > 0): ?>
                                    <ul class="list-inline">
                                        <h7 class="text-muted">Sectors:</h7>
                                        <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-inline-item text-muted" style="border: 1px solid #ddd; padding: 5px; border-radius: 5px; margin-right: 5px; margin-bottom: 5px; background-color: #f8f9fa;">
                                                <?php echo e(ucwords(strtolower($sector))); ?>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </p>
                        </div>

                        <!-- Action Button -->
                        <div class="col-md-4 text-end">
                            <?php if($approved || $isSubscribed): ?>
                                <a href="<?php echo e(route('investeedashboard.investorlistdetail',['id' => $investor->id])); ?>" 
                                   class="btn btn-primary btn-sm">🔍 View Details</a>
                            <?php else: ?>
                                <span class="btn btn-primary btn-sm disabled" style="cursor: not-allowed; pointer-events: none;">
                                    🔒 Locked
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php else: ?>
<div class="container mt-5 <?php echo e(!$isSubscribed ? 'locked-content' : ''); ?>">
    <h2 class="text-center mb-4 fw-bold text-dark">No Investors Found</h2>
    <p class="text-center">Please check back later or consider subscribing for more options.</p>
</div>
<?php endif; ?>

<!-- <?php if($showSubscribeMessage): ?>
<div class="col-md-12 text-center mt-4">
    <div class="alert subscription-box">
        <h5 class="fw-bold">🔒 Unlock Full Access!</h5>
        <p>Subscribe now to view complete details and get unlimited access to all investees on this platform.</p>
        <a href="<?php echo e(route('subscription')); ?>" class="btn btn-warning btn-lg">🚀 Subscribe Now</a>
    </div>
</div>
<?php endif; ?> -->

<style>
    .investor-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .investor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
    }
    .profile-wrapper { position: relative; display: inline-block; }
    .profile-img { width: 90px; height: 90px; border-radius: 50%; border: 4px solid #ddd; }
    .premium-badge { position: absolute; top: 5px; right: 5px; background: gold; color: black; font-size: 12px; padding: 4px 8px; border-radius: 8px; font-weight: bold; }
    .locked-content { filter: blur(5px); opacity: 0.6; pointer-events: none; user-select: none; }
    .subscription-box { background: #fffae6; padding: 20px; border-radius: 12px; transition: 0.3s; }
    .subscription-box:hover { background: #ffe5b4; }
</style>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/partials/investor_list.blade.php ENDPATH**/ ?>