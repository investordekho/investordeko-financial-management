

<?php $__env->startSection('content'); ?>
<div style="display:flex; justify-content:center; align-items: left; margin-bottom:10px; padding: 10px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transaction 0.3s;">
    <div class="sidebar">
    <h3>Profile</h3>
        <ul>
            <li><a href="#company-detail">Company Name</a></li>
            <li><a href="#company-founders">Company Founders</a></li>
            <li><a href="#company-concerned-person">Company Concerned Person</a></li>
            <li><a href="#company-fund-requirements">Company Fund Requirements</a></li>
            <li><a href="#company-previous-rounds">Company Previous Rounds</a></li>
            <li><a href="#company-other-links">Company Other Links</a></li>
            <li><a href="#company-attachments">Company Attachments</a></li>
            <li><a href="#company-referral-sources">Company Referral Sources</a></li>
        </ul>
    </div>
    <div style="min-width: 850px; margin-left: 10px; background:rgb(255, 255, 255); border-radius: 12px; padding: 25px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); transition: 0.3s; border: 1px solid #ccc;">

            <h2 id="company-detail" style="text-align: center; color: white; margin-bottom: 20px; padding: 12px; border-radius: 12px; background: linear-gradient(to right, #174a7d, #13507a); box-shadow: 0px 5px 15px rgba(0,0,0,0.1);">
                <span style="color: rgb(199, 210, 223);">Company Details</span>
            </h2>

        
            <div style="margin-bottom: 20px; text-align: center;">
                <h4 style="color: #222; font-size: 22px; border-radius: 8px; background: white; padding: 6px 10px; display: inline-block; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);">
                    <mark style="background: none;"><?php echo e($investee->company_name); ?></mark>
                </h4>
                <p style="color: #666; font-size: 16px;"><?php echo e($investee->nature_of_business); ?></p>
            </div>

            <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                <div style="width: 48%;">
                    <p><strong>📍 Address:</strong> <span style="font-style: italic;"><?php echo e($investee->address); ?></span></p>
                    <p><strong>📆 Incorporated In:</strong> <time datetime="<?php echo e($investee->incorporated_in); ?>"><?php echo e($investee->incorporated_in); ?></time></p>
                    <p><strong>🌐 Website:</strong> <a href="<?php echo e($investee->website); ?>" target="_blank" style="color: #007bff; text-decoration: none;"><?php echo e($investee->website); ?></a></p>
                    <p><strong>🔗 LinkedIn:</strong> <a href="<?php echo e($investee->linkedin); ?>" target="_blank" style="color: #007bff; text-decoration: none;"><?php echo e($investee->linkedin); ?></a></p>
                </div>
                <div style="width: 48%;">
                    <p><strong>👤 User:</strong> <span style="font-weight: bold;"><?php echo e($investee->user->name ?? 'N/A'); ?></span></p>
                    <p><strong>📧 Email:</strong> <abbr title="Email Address"><?php echo e($investee->user->email ?? 'N/A'); ?></abbr></p>
                    <p><strong>📞 Phone:</strong> <code><?php echo e($investee->user->phone ?? 'N/A'); ?></code></p>
                </div>
            </div>

            <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

       
            <h4 id="company-founders" style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🚀 Founders</h4>
            <ul style="list-style: none; padding: 0;">
                <?php $__currentLoopData = $investee->founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px; transition: 0.3s;">
                        <strong><?php echo e($founder->name); ?></strong> - <span style="text-transform: uppercase;"><?php echo e($founder->position); ?></span> 
                        (<em><?php echo e($founder->education); ?></em>, <small><?php echo e($founder->experience); ?> years</small>)
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

      
            <h4 id="company-concerned-person" style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🔎 Concerned Persons</h4>
            <?php if($investee->concernedPerson): ?>
            <blockquote style="border-left: 5px solid #007bff; padding-left: 10px; font-style: italic; background: #eef4ff; padding: 12px; border-radius: 8px;">
                <p><strong><?php echo e($investee->concernedPerson->name); ?></strong> - <?php echo e($investee->concernedPerson->designation); ?></p>
                <p>Email: <?php echo e($investee->concernedPerson->email); ?> | Phone: <?php echo e($investee->concernedPerson->phone); ?></p>
            </blockquote>
            <?php else: ?>
                <p style="color: #666; text-align: center;">No concerned person found.</p>
            <?php endif; ?>

            <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">
       
            <h4 id="company-fund-requirements" style="text-align:center; border-bottom: 2px solid #ddd; padding-bottom:5px;">Fund Requirements</h4>
            <ul style="list-style:none; padding:0;">
                    <?php $__currentLoopData = $investee->fundRequirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="background: #fafafa; border: 1px solid #ddd; padding: 10px; margin-bottom:5px; border-raadius:6px;">
                            <strong>Usage:</strong> <?php echo e($fund->usage); ?> | <strong>Amount:</strong> <?php echo e(number_format($fund->amount,2)); ?> <?php echo e($fund->unit); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </ul>

            <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">
      

            <h4 id="company-previous-rounds" style="text-align:center; border-bottom:2px; padding-bottom:5px;">Previus Investment Rounds</h4>
            <ul style="list-style: none; padding:0;">
                <?php $__currentLoopData = $investee->previousRounds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $round): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="background: #fafafa; border:1px solid #ddd; padding:10px; margin-botton:5px; border-radius:6px;">
                        <strong>Round:</strong> <?php echo e($round->round); ?> | <strong>Investors:</strong> <?php echo e($round->investors); ?> <br>
                        <strong>Amount Raised:<strong> <?php echo e(number_format($round->amount_raised,2)); ?> crores | <strong>Valiuation:</strong> <?php echo e(number_format($round->valuation,2)); ?> crores
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </ul>    

            <hr style="margin: 20px 0; border: none:height:2px;  background: linear-gradient(to right, #ccc, transparent);">
      
                <h4 id="company-other-links" style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">🔗 Other Links</h4>
                <ul style="list-style: none; padding: 0;">
                    <?php $__currentLoopData = $investee->otherLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px;">
                            <a href="<?php echo e($link->link_url); ?>" target="_blank" style="color: #007bff; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                                <?php echo e($link->link_description); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

           
                <h4 id="company-attachments" style="text-align: center; border-bottom:2px; padding-bottom:5px;">   📄 Attachments</h4>
                <ul style="list-style:none; padding:0;">
                    <?php $i = 1; ?>

                    <?php $__currentLoopData = $investee->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="background: #fafafa;  boder: 1px solid #ddd; padding: 12px; margin-bottom: 6px; boder-radius: 8px;">
                            <a href="<?php echo e(asset('storage/'.$attachment->file_path)); ?>" target="_blank" download="<?php echo e($attachment->file_name); ?>" style="color: #007bff; text-decoration:none; transition: 0.3s;" onmouseover="this.style.color='#ff5733'" onmouseout="this.style.color='#007bff'">
                                <i class="fa fa-download"> file <?php echo e($i++); ?> </i>
                            </a>    
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                <hr style="margin: 20px 0; border: none; height: 2px; background: linear-gradient(to right, #ccc, transparent);">

                <!-- Referral Sources -->
                <h4 id="company-referral-sources" style="text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 5px;">📌 Referral Sources</h4>
                <ul style="list-style: none; padding: 0;">
                    <li style="background: #fafafa; border: 1px solid #ddd; padding: 12px; margin-bottom: 6px; border-radius: 8px;">
                        <dfn><?php echo e($investee->source_name ?? 'N/A'); ?></dfn>
                    </li>
                </ul>
        </div>
    </div>



    <style>
    /* Sidebar Styling */
.sidebar {
    width: 250px;
    background: #ffffff;
    padding: 5px;
    border-radius: 12px;
    box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.sidebar h3 {
    font-size: 10px;
    font-weight: bold;
    text-align: center;
    padding: 10px;
    background: linear-gradient(to right, #174a7d, #13507a);
    color: white;
    border-radius: 8px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}

.sidebar ul li {
    margin: 10px 0;
    padding: 10px;
    border-radius: 8px;
    transition: 0.3s ease;
}

.sidebar ul li a {
    text-decoration: none;
    font-size: 14px;
    color: #333;
    display: block;
    padding: 10px;
    border-radius: 8px;4
    transition: all 0.3s ease-in-out;
}

.sidebar ul li a:hover {
    background: #174a7d;
    color: white;
}

/* Main Content */
.main-content {
    flex: 1;
    min-width: 850px;
    margin-left: 10px;
    background: #ffffff;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
    border: 1px solid #ccc;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        margin-bottom: 20px;
    }
    .main-content {
        min-width: 100%;
        margin-left: 0;
    }
}

    </style>
<?php $__env->stopSection(); ?>












 


















<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/partials/investee_list_detail.blade.php ENDPATH**/ ?>