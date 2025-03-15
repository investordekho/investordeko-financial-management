<style>
    .blurred-content {
    filter: blur(5px); /* You can adjust the blur value */
    opacity: 0.5;
}
</style>

<div class="row mt-4" id="investorList">
    <?php if($investors->count()): ?>
        <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12 mb-4">
                <div class="investor-entry p-3 rounded shadow-sm" style="background-color: #f8f9fa; color: black;">
                    <div class="row">
                        <!-- Profile Image -->
                        <div class="col-md-2 center-image" style="width:90px; height: 90px;">
    <img src="<?php echo e($investor->profile_image ? asset('uploads/' . $investor->profile_image) : asset('img/default_profile.png')); ?>" class="img-fluid rounded-circle" alt="Investor Logo">
</div>


                        <!-- Investor Name and Address -->
                        <div class="col-md-6 center-text">
                            <h2 class="nameE <?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>">
                                <?php echo e($investor->investor_name); ?>

                            </h2>
                            <p class="mt-2 <?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>" style="font-size: 18px;">
                                <i class="bi bi-geo-alt-fill" style="color: #5e6469;"></i>
                                <?php echo e($investor->address); ?> | 
                                <i>Member since <?php echo e($investor->investmentDetails->member_since ?? 'N/A'); ?></i> <!-- Fetching member_since -->
                            </p>
                        </div>

                        <!-- Buy MCA Filings Button -->
                        <div class="col-md-4 d-flex justify-content-end align-items-center">
                            <!--<button class="btn btn-dark text-white">✍️ Buy MCA Filings</button>
 -->                        </div>
                    </div>

                    <hr>

                    <!-- Investment Details -->
                    <div class="row">
                        <!-- Investment Type -->
                        <div class="col-md-3">
                            <strong>
                                <i class="bi bi-briefcase" style="color: #5e6469; font-size: 1.8rem;"></i>
                                <span class="investmentspan2" style="color: black;">Investment Type</span>
                            </strong>
                            <br>
                            <strong>
                                <span style="color: #7c7f83;" class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>">
                                    <?php echo e($investor->investmentDetails->investor_type ?? 'N/A'); ?> <!-- Fetching investor_type from investmentDetails -->
                                </span>
                            </strong>
                        </div>

                        <!-- Investment Size -->
                        <div class="col-md-3">
                            <strong>
                                <i class="bi bi-cash-coin" style="color: #5e6469; font-size: 1.8rem;"></i>
                                <span class="investmentspan2" style="color: black;">Investment Size</span>
                            </strong>
                            <br>
                            <strong>
                                <span style="color: #7c7f83;" class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>">
                                    <?php echo e($investor->investmentDetails->investment_size ?? 'N/A'); ?> <!-- Fetching investment_size -->
                                </span>
                            </strong>
                        </div>

                        <!-- Investment Tenure -->
                        <div class="col-md-3">
                            <strong>
                                <i class="bi bi-calendar4" style="color: #5e6469; font-size: 1.8rem;"></i>
                                <span class="investmentspan2" style="color: black;">Investment Tenure</span>
                            </strong>
                            <br>
                            <strong>
                                <span style="color: #7c7f83;" class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>">
                                    <?php echo e($investor->investmentDetails->investment_tenure ?? 'N/A'); ?> <!-- Fetching investment_tenure -->
                                </span>
                            </strong>
                        </div>

                        <!-- Sector Preferred -->
                        <div class="col-md-3">
                            <strong>
                                <i class="bi bi-tags" style="color: #5e6469; font-size: 1.8rem;"></i>
                                <span class="investmentspan2" style="color: black;">Sector Preferred</span>
                            </strong>
                            <br>
                            <strong>
                                <span style="color: #7c7f83;" class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : ''); ?>">
                                <?php
                                    $sectors_preferred = $investor->sectors_preferred;

                                    if (!empty($sectors_preferred)) {
                                        // Explode the string into an array based on commas and trim spaces.
                                        $sectors_array = array_map('trim', explode(',', $sectors_preferred));
                                        echo implode(', ', $sectors_array); // Display as a comma-separated list
                                    } else {
                                        echo "No sectors preferred";
                                    }
                                ?>
                                </span>
                            </strong>
                        </div>
                    </div>

                   <br>

                    <!-- Public Links Section -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <strong style="color: black;">Public Links:</strong>
                            <?php if($investor->publicLinks->count()): ?>
                                <?php $__currentLoopData = $investor->publicLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($link->url); ?>" class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : 'badge bg-dark'); ?>" target="_blank"><?php echo e($link->link_description); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p>No valid public links available</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Previous Investments Section -->
                    <div class="row mt-3">
                        <div class="<?php echo e(!$subscriber || !$subscriber->is_subscribed ? 'blurred-content' : 'col-md-12'); ?>">
                            <strong style="color: black;">Previous Investments:</strong>
                            <?php if($investor->previousInvestments->count()): ?>
                                <?php $__currentLoopData = $investor->previousInvestments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p style="font-size: 18px; font-weight: 400; color: black;">
                                        <strong>Year: </strong><?php echo e($investment->previous_investment_year); ?>, <b>| </b>
                                        <strong>Company:</strong> <?php echo e($investment->previous_investment_company); ?>, <b>|</b>
                                       <b> Sector:</b> <?php echo e($investment->sector); ?>

                                    </p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p style="font-size: 18px; font-weight: 400; color: black;">N/A</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- Subscription Prompt for Unsubscribed Users -->
        <?php if(!$subscriber || !$subscriber->is_subscribed && $investors->count() == 3): ?>
            <div class="col-md-12 text-center">
                <p style="color: black;">Get access to information on all 10,750+ Angel Investors investing in Indian startups.</p>
                <p style="color: black;">The full list is available only for subscribers. Upgrade to a full subscription and get all the benefits of this unique platform. Go for it now! 🚀</p>
                <a href="<?php echo e(route('subscription')); ?>" class="btn btn-dark text-white">Subscribe Now</a>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>No investors found matching your criteria.</p>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/partials/investor_list.blade.php ENDPATH**/ ?>