<?php $__env->startSection('content'); ?>



                <style>
                    .required::after {
                        content: " *";
                        color: red;
                    }
                    
                    .g-3, .gy-3 {
    --bs-gutter-y: 0.51rem;
}
                    
                    #sectors_preferred_list {
    position: absolute;
    background-color: white;
    max-height: 200px;
    width: 100%;
    overflow-y: auto;
    border: 1px solid #ddd;
    z-index: 10;
    display: none;
    padding: 10px;
}
.form-group {
    position: relative; /* Ensures dropdown stays in the same place */
}

.text-danger{
    font-size: 12px;
}
#investorForm h3 {
    font-size: 24px; /* Moderate font size */
    font-weight: 400; /* Regular weight for a clean look */
    color: #555; /* Dark gray for a neutral tone */
    text-transform: none; /* Remove uppercase transformation */
    letter-spacing: 0.5px; /* Slight spacing for readability */
    margin-bottom: 15px; /* Space between heading and content */
    font-family: 'Arial', sans-serif; /* Simple, modern font */
}




                </style>
<div class="container">
    <div class="col-sm-12">
                    

    <form id="investorForm"
      action="<?php echo e(route('form.investor.submit')); ?>"
      method="POST"
      enctype="multipart/form-data"
      style="background: linear-gradient(135deg, #ffffff, #f0f0f0); 
             color: #2e2e2e; 
             padding: 40px; 
             border-radius: 16px; 
             box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);"
      novalidate>
    <?php echo csrf_field(); ?>


                    <!-- Investor Profile Section -->

            <div class="row g-3 mb-1">
            <label style="font-size: 20px; font-weight: 600; color: #2C3E50; display: inline-block; padding: 8px 16px; background-color: #ECF0F1; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 2px 5px rgba(0, 0, 0, 0.1); text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease-in-out; text-align: center;" 
    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0, 0, 0, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1)';"
    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.1), 0 2px 5px rgba(0, 0, 0, 0.1)';">
    Investor Registration Form
</label>




                    <div class="col-sm-2">
                        <label></label>
                        <h3 style="font-size: 22px; font-weight: 600;">Investor Profile</h3>
                    </div>
                   <div class="col-sm-2">
    <label id="labelinput" for="investor_name" class="required">Investor Name</label>
    <input
        type="text"
        class="form-control spaced-input <?php $__errorArgs = ['investor_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        id="investor_name"
        name="investor_name"
        value="<?php echo e(old('investor_name')); ?>"
        required
    >
    <?php $__errorArgs = ['investor_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This field is required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
























                   <div class="col-sm-3 form-group">
                    <label id="labelinput" for="sectors_preferred" class="required">Sectors Preferred</label>
                    <input
                        type="text"
                        class="form-control spaced-input <?php $__errorArgs = ['sectors_preferred'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="sectors_preferred_input"
                        placeholder="Select sectors"
                        readonly
                        onclick="toggleDropdown()"
                        value="<?php echo e(old('sectors_preferred') ? implode(', ', old('sectors_preferred')) : ''); ?>"
                    >
                    <?php $__errorArgs = ['sectors_preferred'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger">This field is required</span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div id="sectors_preferred_list" class="dropdown-list" style="display:none; max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-top: 0px; max-width: 95%; background-color: white; z-index: 10;">
                        <?php
                            $sectors = [
                                'Accounting', 'Airlines/Aviation', 'Alternative Dispute Resolution', 'Alternative Medicine', 'Animation', 'Apparel/Fashion', 
                                'Architecture/Planning', 'Arts/Crafts', 'Automotive', 'Aviation/Aerospace', 'Banking/Mortgage', 'Biotechnology/Greentech', 
                                'Broadcast Media', 'Building Materials', 'Business Supplies/Equipment', 'Capital Markets/Hedge Fund/Private Equity', 
                                'Chemicals', 'Civic/Social Organization', 'Civil Engineering', 'Commercial Real Estate', 'Computer Games', 
                                'Computer Hardware', 'Computer Networking', 'Computer Software/Engineering', 'Computer/Network Security', 'Construction', 
                                'Consumer Electronics', 'Consumer Goods', 'Consumer Services', 'Cosmetics', 'Dairy', 'Defense/Space', 'Design', 
                                'E-Learning', 'Education Management', 'Electrical/Electronic Manufacturing', 'Entertainment/Movie Production', 
                                'Environmental Services', 'Events Services', 'Executive Office', 'Facilities Services', 'Farming', 'Financial Services', 
                                'Fine Art', 'Fishery', 'Food Production', 'Food/Beverages', 'Fundraising', 'Furniture', 'Gambling/Casinos', 
                                'Glass/Ceramics/Concrete', 'Government Administration', 'Government Relations', 'Graphic Design/Web Design', 
                                'Health/Fitness', 'Higher Education/Acadamia', 'Hospital/Health Care', 'Hospitality', 'Human Resources/HR', 
                                'Import/Export', 'Individual/Family Services', 'Industrial Automation', 'Information Services', 'Information Technology/IT', 
                                'Insurance', 'International Affairs', 'International Trade/Development', 'Internet', 'Investment Banking/Venture', 
                                'Investment Management/Hedge Fund/Private Equity', 'Judiciary', 'Law Enforcement', 'Law Practice/Law Firms', 'Legal Services', 
                                'Legislative Office', 'Leisure/Travel', 'Library', 'Logistics/Procurement', 'Luxury Goods/Jewelry', 'Machinery', 
                                'Management Consulting', 'Maritime', 'Market Research', 'Marketing/Advertising/Sales', 'Mechanical or Industrial Engineering', 
                                'Media Production', 'Medical Equipment', 'Medical Practice', 'Mental Health Care', 'Military Industry', 'Mining/Metals', 
                                'Motion Pictures/Film', 'Museums/Institutions', 'Music', 'Nanotechnology', 'Newspapers/Journalism', 'Non-Profit/Volunteering', 
                                'Oil/Energy/Solar/Greentech', 'Online Publishing', 'Other Industry', 'Outsourcing/Offshoring', 'Package/Freight Delivery', 
                                'Packaging/Containers', 'Paper/Forest Products', 'Performing Arts', 'Pharmaceuticals', 'Philanthropy', 'Photography', 
                                'Plastics', 'Political Organization', 'Primary/Secondary Education', 'Printing', 'Professional Training', 
                                'Program Development', 'Public Relations/PR', 'Public Safety', 'Publishing Industry', 'Railroad Manufacture', 
                                'Ranching', 'Real Estate/Mortgage', 'Recreational Facilities/Services', 'Religious Institutions', 'Renewables/Environment', 
                                'Research Industry', 'Restaurants', 'Retail Industry', 'Security/Investigations', 'Semiconductors', 'Shipbuilding', 
                                'Sporting Goods', 'Sports', 'Staffing/Recruiting', 'Supermarkets', 'Telecommunications', 'Textiles', 'Think Tanks', 
                                'Tobacco', 'Translation/Localization', 'Transportation', 'Utilities', 'Venture Capital/VC', 'Veterinary', 'Warehousing', 
                                'Wholesale', 'Wine/Spirits', 'Wireless', 'Writing/Editing'
                            ];
                        ?>
                        <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label>
                                <input
                                    type="checkbox"
                                    class="sector-checkbox"
                                    value="<?php echo e($sector); ?>"
                                    <?php echo e(old('sectors_preferred') && in_array($sector, old('sectors_preferred')) ? 'checked' : ''); ?>

                                > 
                                <?php echo e($sector); ?>

                            </label><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" id="sectors_preferred_hidden" name="sectors_preferred[]" value="<?php echo e(old('sectors_preferred') ? implode(',', old('sectors_preferred')) : ''); ?>">
                   </div>






















    <div class="col-sm-2">
    <label id="labelinput" for="Address" class="required">Address</label>
    <input 
        type="text" 
        class="form-control spaced-input <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
        id="Address" 
        name="address" 
        value="<?php echo e(old('address')); ?>" 
        required
    >
    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This field is required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="col-sm-3">
    <label id="labelinput" for="investor_profile">Investor Profile</label>
    <input 
        type="file" 
        class="form-control spaced-input <?php $__errorArgs = ['investor_profile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
        id="investor_profile" 
        name="investor_profile"
    >
    <?php $__errorArgs = ['investor_profile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This field is required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<hr>
                  <div class="row g-3 mb-4">
    <div class="col-sm-2">
        <h3 style="font-size: 22px; font-weight: 600;">Contact Details</h3>
        <input 
            type="checkbox" 
            class="form-check-input" 
            id="concerned_person_is_me" 
            name="concerned_person_is_me"
            value="1"
            <?php echo e(old('concerned_person_is_me') ? 'checked' : ''); ?>

            onclick="fillConcernedPersonDetails()"
        >
        <label class="form-check-label" for="concerned_person_is_me" style="font-size: 9px; color: red;">Same as registered person</label>
    </div>
    <div class="col-sm-3">
        <label id="labelinput" for="concerned_person_name" class="required">Concerned Person</label>
        <input 
            type="text" 
            class="form-control spaced-input <?php $__errorArgs = ['concerned_person_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="concerned_person_name" 
            name="concerned_person_name" 
            value="<?php echo e(old('concerned_person_name')); ?>" 
            required
        >
        <?php $__errorArgs = ['concerned_person_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-2">
        <label id="labelinput" for="concerned_person_designation" class="required">Designation</label>
        <input 
            type="text" 
            class="form-control spaced-input <?php $__errorArgs = ['concerned_person_designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="concerned_person_designation" 
            name="concerned_person_designation" 
            value="<?php echo e(old('concerned_person_designation')); ?>" 
            required
        >
        <?php $__errorArgs = ['concerned_person_designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-2">
        <label id="labelinput" for="concerned_person_phone" class="required">Phone No.</label>
        <input 
            type="tel" 
            class="form-control spaced-input <?php $__errorArgs = ['concerned_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="concerned_person_phone" 
            name="concerned_person_phone" 
            maxlength="10" 
            value="<?php echo e(old('concerned_person_phone')); ?>" 
            required
        >
        <?php $__errorArgs = ['concerned_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-3">
        <label id="labelinput" for="email" class="required">Email</label>
        <input 
            type="email" 
            class="form-control spaced-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="email" 
            name="email" 
            value="<?php echo e(old('email')); ?>" 
            required
        >
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>


                 <div class="row g-3 mb-3 bordered-row">
    <div class="col-sm-2">
        <label></label>
        <h3 style="font-size: 22px; font-weight: 600;">Public Links</h3>
    </div>

    <!-- <div id="public-links-container" class="col-sm-10">
        <div class="public-link-row d-flex align-items-start">
            <div class="form-group flex-grow-1 mr-2">
                <label for="public_links" class="required">URL</label>
                <div>
                    <input 
                        type="url" 
                        class="form-control spaced-input <?php $__errorArgs = ['public_links.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        name="public_links[]" 
                        placeholder="Enter URL" 
                        value="<?php echo e(old('public_links.0')); ?>" 
                        required
                    >
                </div>
                <?php $__errorArgs = ['public_links.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-1">
                        <span class="text-danger">This field is required</span>
                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class="required">Select Account</label>
                <div>
                    <select 
                        class="form-control spaced-input <?php $__errorArgs = ['link_descriptions.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        name="link_descriptions[]" 
                        required
                    >
                        <option value="Facebook" <?php echo e(old('link_descriptions.0') == 'Facebook' ? 'selected' : ''); ?>>Facebook</option>
                        <option value="Twitter" <?php echo e(old('link_descriptions.0') == 'Twitter' ? 'selected' : ''); ?>>Twitter</option>
                        <option value="Instagram" <?php echo e(old('link_descriptions.0') == 'Instagram' ? 'selected' : ''); ?>>Instagram</option>
                        <option value="LinkedIn" <?php echo e(old('link_descriptions.0') == 'LinkedIn' ? 'selected' : ''); ?>>LinkedIn</option>
                        <option value="Others" <?php echo e(old('link_descriptions.0') == 'Others' ? 'selected' : ''); ?>>Others</option>
                    </select>
                </div>
                <?php $__errorArgs = ['link_descriptions.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mt-1">
                        <span class="text-danger">This field is required</span>
                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info add-btn mt-4" onclick="addPublicLinkField(this)">+</button>
            </div>
        </div>
    </div> -->

    <div id="public-links-container" class="col-sm-10">
    <?php
        $publicLinks = old('public_links', []);
        $linkDescriptions = old('link_descriptions', []);
        $count = max(count($publicLinks), 1);
    ?>

    <?php for($i = 0; $i < $count; $i++): ?>
        <div class="public-link-row d-flex align-items-start mb-2">
            <div class="form-group flex-grow-1 mr-2">
                <label for="public_links" class="<?php echo e($i == 0 ? 'required' : ''); ?>"><?php echo e($i == 0 ? 'URL' : ''); ?></label>
                <input 
                    type="url" 
                    class="form-control spaced-input <?php $__errorArgs = ["public_links.$i"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="public_links[]" 
                    placeholder="Enter URL" 
                    value="<?php echo e($publicLinks[$i] ?? ''); ?>" 
                    required
                >
                <?php $__errorArgs = ["public_links.$i"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This field is required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class="<?php echo e($i == 0 ? 'required' : ''); ?>"><?php echo e($i == 0 ? 'Select Account' : ''); ?></label>
                <select 
                    class="form-control spaced-input <?php $__errorArgs = ["link_descriptions.$i"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="link_descriptions[]" 
                    required
                >
                    <?php $__currentLoopData = ['Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'Others']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($option); ?>" <?php echo e(($linkDescriptions[$i] ?? '') == $option ? 'selected' : ''); ?>><?php echo e($option); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ["link_descriptions.$i"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This field is required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <?php if($i == 0): ?>
                    <button type="button" class="btn btn-info add-btn mt-4" onclick="addPublicLinkField(this)">+</button>
                <?php else: ?>
                    <button type="button" class="btn btn-danger remove-btn mt-4" onclick="removePublicLinkField(this)">-</button>
                <?php endif; ?>
            </div>
        </div>
    <?php endfor; ?>
</div>

</div>



                    <!-- Investment Details Section -->
                  <div class="row g-3 mb-4">
    <div class="heading-with-hr">
        <h3 style="font-size: 22px; font-weight: 600;">Investment Details</h3>
        <hr>
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="invest_in" class="required">Invest In</label>
        <select 
            class="form-control spaced-input <?php $__errorArgs = ['invest_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="invest_in" 
            name="invest_in" 
            required
        >
            <option value="listed shares" <?php echo e(old('invest_in') == 'listed shares' ? 'selected' : ''); ?>>Listed shares</option>
            <option value="unlisted shares" <?php echo e(old('invest_in') == 'unlisted shares' ? 'selected' : ''); ?>>Unlisted shares</option>
            <option value="both" <?php echo e(old('invest_in') == 'both' ? 'selected' : ''); ?>>Both</option>
        </select>
        <?php $__errorArgs = ['invest_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investor_type" class="required">Investor Type</label>
        <select 
            class="form-control spaced-input <?php $__errorArgs = ['investor_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="investor_type" 
            name="investor_type" 
            required
        >
            <option value="Angel Investor" <?php echo e(old('investor_type') == 'Angel Investor' ? 'selected' : ''); ?>>Angel Investor</option>
            <option value="Private Equity" <?php echo e(old('investor_type') == 'Private Equity' ? 'selected' : ''); ?>>Private Equity</option>
            <option value="Venture Capital" <?php echo e(old('investor_type') == 'Venture Capital' ? 'selected' : ''); ?>>Venture Capital</option>
            <option value="Family Office" <?php echo e(old('investor_type') == 'Family Office' ? 'selected' : ''); ?>>Family Office</option>
        </select>
        <?php $__errorArgs = ['investor_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investment_size" class="required">Avg. Investment Size</label>
        <select 
            class="form-control spaced-input <?php $__errorArgs = ['investment_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="investment_size" 
            name="investment_size" 
            required
        >
            <option value="10 cr" <?php echo e(old('investment_size') == '10 cr' ? 'selected' : ''); ?>>Less than 10 Cr</option>
            <option value="10-50 Cr" <?php echo e(old('investment_size') == '10-50 Cr' ? 'selected' : ''); ?>>10 - 50 Cr</option>
            <option value="50-100 Cr" <?php echo e(old('investment_size') == '50-100 Cr' ? 'selected' : ''); ?>>50 - 100 Cr</option>
            <option value=">100+ Cr" <?php echo e(old('investment_size') == '>100+ Cr' ? 'selected' : ''); ?>>More than 100 Cr</option>
        </select>
        <?php $__errorArgs = ['investment_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-sm-3 form-group">
        <label id="labelinput" for="investment_tenure" class="required">Avg. Investment Tenure</label>
        <select 
            class="form-control spaced-input <?php $__errorArgs = ['investment_tenure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="investment_tenure" 
            name="investment_tenure" 
            required
        >
            <option value="1 Years" <?php echo e(old('investment_tenure') == '1 Years' ? 'selected' : ''); ?>>Less than 1 year</option>
            <option value="3 Years" <?php echo e(old('investment_tenure') == '3 Years' ? 'selected' : ''); ?>>1 - 3 years</option>
            <option value="5 Years" <?php echo e(old('investment_tenure') == '5 Years' ? 'selected' : ''); ?>>3 - 5 years</option>
            <option value="7 Years" <?php echo e(old('investment_tenure') == '7 Years' ? 'selected' : ''); ?>>5 - 7 years</option>
        </select>
        <?php $__errorArgs = ['investment_tenure'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This field is required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>













































































































                    <!-- Previous Investments Section -->
                  <div class="row g-3 bordered-row">
                        <div class="heading-with-hr">
                            <h3 style="font-size: 22px; font-weight: 600;">Previous Investments</h3>
                            <hr>
                        </div>
                        <!-- Previous Investments Section -->
                        <div id="previous-investments-container">

                        <?php
                            $previousInvestmentYears = old('previous_investment_year', []);
                            $previousInvestmentCompanies = old('previous_investment_company', []);
                            $sectors = old('sector', []);
                            $count = max(count($previousInvestmentCompanies), 1);
                        ?>
                            
                           <?php for( $i =0; $i< $count; $i++): ?>
                            <div class="row g-3 previous-investment-row">
                                <div class="col-sm-3 form-group">
                                    <label id="labelinput" for="previous_investment_year" class="<?php echo e($i==0 ? 'required' : ''); ?>"><?php echo e($i == 0 ? 'Year' : ''); ?></label>
                                     <select 
                                        class="form-control spaced-input <?php $__errorArgs = ['previous_investment_year.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="previous_investment_year" 
                                        name="previous_investment_year[]" 
                                        required
                                        value="<?php echo e($previousInvestmentYears[$i] ?? ''); ?>"
                                        >
                                        <?php for($year = 2000; $year <= 2024; $year++): ?>
                                            <option value="<?php echo e($year); ?>" <?php echo e(($previousInvestmentYears[$i] ?? '') == $year ? 'selected' : ''); ?>><?php echo e($year); ?></option>
                                        <?php endfor; ?>
                                    </select>

                                    <?php $__errorArgs = ['previous_investment_year.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger">This field is required</span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label id="labelinput" for="previous_investment_company" class="<?php echo e($i==0 ? 'required' : ''); ?>"><?php echo e($i == 0 ? 'Company' : ''); ?></label>
                                    <input 
                                        type="text" 
                                        class="form-control spaced-input <?php $__errorArgs = ['previous_investment_company.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="previous_investment_company" 
                                        name="previous_investment_company[]" 
                                        value="<?php echo e($previousInvestmentCompanies[$i] ?? ''); ?>" 
                                        required
                                    >
                                    <?php $__errorArgs = ['previous_investment_company.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger">This field is required</span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label id="labelinput" for="sector" class="<?php echo e($i==0 ? 'required' : ''); ?>"><?php echo e($i == 0 ? 'Sector' : ''); ?></label>
                                    <input 
                                        type="text" 
                                        class="form-control spaced-input <?php $__errorArgs = ['sector.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="sector" 
                                        name="sector[]" 
                                        value="<?php echo e($sectors[$i] ?? ''); ?>" 
                                        required
                                    >
                                    <?php $__errorArgs = ['sector.' . $i];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger">This field is required</span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <?php if($i == 0): ?>
                                        <button type="button" class="btn btn-info mt-4" onclick="addPreviousInvestmentField(this)">+ Add More</button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-danger mt-4" onclick="removePreviousInvestmentField(this)">×</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>    

























<!-- 
                            <?php if(old('previous_investment_year') && is_array(old('previous_investment_year'))): ?>
                                <?php $__currentLoopData = old('previous_investment_year'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row g-3 previous-investment-row">
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                                            <select 
                                                class="form-control spaced-input <?php $__errorArgs = ['previous_investment_year.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                id="previous_investment_year" 
                                                name="previous_investment_year[]"
                                                required
                                            >
                                                <?php for($yr = 2000; $yr <= 2024; $yr++): ?>
                                                    <option value="<?php echo e($yr); ?>" <?php echo e($year == $yr ? 'selected' : ''); ?>><?php echo e($yr); ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <?php $__errorArgs = ['previous_investment_year.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger">This field is required</span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                                            <input 
                                                type="text" 
                                                class="form-control spaced-input <?php $__errorArgs = ['previous_investment_company.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                id="previous_investment_company" 
                                                name="previous_investment_company[]" 
                                                value="<?php echo e(old('previous_investment_company.' . $index)); ?>" 
                                                required
                                            >
                                            <?php $__errorArgs = ['previous_investment_company.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger">This field is required</span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <label id="labelinput" for="sector" class="required">Sector</label>
                                            <input 
                                                type="text" 
                                                class="form-control spaced-input <?php $__errorArgs = ['sector.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                id="sector" 
                                                name="sector[]" 
                                                value="<?php echo e(old('sector.' . $index)); ?>" 
                                                required
                                            >
                                            <?php $__errorArgs = ['sector.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger">This field is required</span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-sm-3 form-group">
                                            <button type="button" class="btn btn-danger mt-4" onclick="removePreviousInvestmentField(this)">×</button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                              
                                <div class="row g-3 previous-investment-row">
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                                        <select 
                                            class="form-control spaced-input" 
                                            id="previous_investment_year" 
                                            name="previous_investment_year[]"
                                            required
                                        >
                                            <?php for($year = 2000; $year <= 2024; $year++): ?>
                                                <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                                        <input 
                                            type="text" 
                                            class="form-control spaced-input" 
                                            id="previous_investment_company" 
                                            name="previous_investment_company[]" 
                                            required
                                        >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label id="labelinput" for="sector" class="required">Sector</label>
                                        <input 
                                            type="text" 
                                            class="form-control spaced-input" 
                                            id="sector" 
                                            name="sector[]" 
                                            required
                                        >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <button type="button" class="btn btn-info mt-4" onclick="addPreviousInvestmentField(this)">+ Add More</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    -->





























































































                    <!-- Referral and Guidance Section -->
                    <div class="row g-3">
                        <div class="heading-with-hr">
                            <h3 style="font-size: 22px; font-weight: 600;">How did you hear about Investor Dekho?</h3>
                            <hr>
                        </div>
                        <div class="form-floating">
                            <label id="labelinput" for="referral_source" class="required">Referral Source</label>
                            <select class="form-control spaced-input" id="referral_source" name="referral_source" required>
                                <option value="" disabled selected>Select Source</option>
                                <option value="Friend/Family">Friend/Family</option>
                                <option value="Social Media (Facebook, Instagram, Twitter, etc.)">Social Media (Facebook, Instagram, Twitter, etc.)</option>
                                <option value="Online Search (Google, Bing, etc.)">Online Search (Google, Bing, etc.)</option>
                                <option value="Advertisement (TV, Radio, Print)">Advertisement (TV, Radio, Print)</option>
                                <option value="Email Newsletter">Email Newsletter</option>
                                <option value="Event/Seminar">Event/Seminar</option>
                                <option value="Professional Referral (Doctor, Lawyer, etc.)">Professional Referral (Doctor, Lawyer, etc.)</option>
                                <option value="Blog/Website">Blog/Website</option>
                                <option value="Direct Mail">Direct Mail</option>
                                <option value="Company Website">Company Website</option>
                            </select>
                        </div>
                    </div>

                    <!-- Guidance Needed Section -->
                    <!-- <div class="row g-3 mb-4 bordered-row">
                        <div class="heading-with-hr">
                            <h3 class="required" style="font-size: 22px; font-weight: 600;">How can we guide you in fund raise?</h3>
                            <hr>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="capital_raise" name="guidance_needed[]" value="Capital Raise">
                                <label class="form-check-label" for="capital_raise">Capital Raise</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="valuation_modelling" name="guidance_needed[]" value="Valuation and Financial Modelling">
                                <label class="form-check-label" for="valuation_modelling">Valuation and Financial Modelling</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ma_advisory" name="guidance_needed[]" value="M&A Advisory">
                                <label class="form-check-label" for="ma_advisory">M&A Advisory</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pitch_deck" name="guidance_needed[]" value="Pitch deck Preparation">
                                <label class="form-check-label" for="pitch_deck">Pitch deck Preparation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="investor_pitching" name="guidance_needed[]" value="Investor Pitching">
                                <label class="form-check-label" for="investor_pitching">Investor Pitching</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="na" name="guidance_needed[]" value="NA">
                                <label class="form-check-label" for="na">NA</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="others_checkbox" name="guidance_needed[]" value="Others" onclick="toggleOtherField()">
                                <label class="form-check-label" for="others_checkbox">Others</label>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="other_field" style="display: none;">
                            <label id="labelinput" for="other_guidance">Please specify (Others)</label>
                            <div id="other_guidance" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                               
                            </div>
                        </div>
                    </div> -->

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Submit</button>
    </form>
</div>
</div>
        </div>

<script>
   
   function toggleDropdown() {
        const dropdown = document.getElementById('sectors_preferred_list');
        dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
    }

    // To handle checkbox selection and show selected sectors in the input field
    const checkboxes = document.querySelectorAll('.sector-checkbox');
    const selectedSectorsInput = document.getElementById('sectors_preferred_input');
    const hiddenSectorsField = document.getElementById('sectors_preferred_hidden');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedSectors = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            // Display selected sectors in the input field
            selectedSectorsInput.value = selectedSectors.join(', ');

            // Update the hidden input for form submission
            hiddenSectorsField.value = selectedSectors.join(',');
        });
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', function (e) {
        if (!document.getElementById('sectors_preferred_input').contains(e.target) && 
            !document.getElementById('sectors_preferred_list').contains(e.target)) {
            document.getElementById('sectors_preferred_list').style.display = 'none';
        }
    });

   function addPublicLinkField(button) {
    // Create a new public link field without changing the + button to - button
    const newField = `
        <div class="public-link-row d-flex align-items-end">
            <div class="form-group flex-grow-1 mr-2" style="max-width: 522px;">
                <label for="public_links" class=""></label>
                <input type="url" class="form-control spaced-input" name="public_links[]" placeholder="Enter URL" required>
            </div>
            <div class="form-group flex-grow-1 mr-2">
                <label for="link_descriptions" class=""></label>
                <select class="form-control spaced-input" name="link_descriptions[]" required>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Instagram">Instagram</option>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="form-group">
    <button type="button"
            class="btn btn-danger remove-btn"
            style="font-size: 20px; padding: 5px 15px;"
            onclick="removePublicLinkField(this)">-</button>
</div>

        </div>`;

    // Append the new field to the container
    document.getElementById('public-links-container').insertAdjacentHTML('beforeend', newField);
}

function removePublicLinkField(button) {
    // Remove the row containing this button
    button.closest('.public-link-row').remove();
}


    // Function to add new investment fields
    function addPreviousInvestmentField() {
        const container = document.getElementById('previous-investments-container');
        const newField = `
            <div class="row g-3 mb-1 investment-row">
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="previous_investment_year" class="required">Year</label>
                    <select class="form-control spaced-input" id="previous_investment_year" name="previous_investment_year[]" required>
                        <?php for($year = 2000; $year <= 2024; $year++): ?>
                            <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="previous_investment_company" class="required">Company</label>
                    <input type="text" class="form-control spaced-input" id="previous_investment_company" name="previous_investment_company[]" required>
                </div>
                <div class="col-sm-3 form-group">
                    <label id="labelinput" for="sector" class="required">Sector</label>
                    <input type="text" class="form-control spaced-input" id="sector" name="sector[]" required>
                </div>
                <div class="col-sm-1 form-group">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeField(this)">x</button>
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newField);
    }

    // Function to remove the investment fields
    function removeField(element) {
        element.closest('.investment-row').remove();
    }


   function toggleOtherField() {
    const otherField = document.getElementById('other_field');
    const otherGuidanceContainer = document.getElementById('other_guidance'); // This will hold the checkboxes

    if (document.getElementById('others_checkbox').checked) {
        // Show the field
        otherField.style.display = 'block';

        // Clear previous checkboxes
        otherGuidanceContainer.innerHTML = '';

        // Array of service categories
        const serviceCategories = [
            'Equity Funding', 'Debt Funding', 'Mergers & Acquisitions', 'Pitchdeck Making',
            'Pitching to Investors', 'IPO Planning', 'IPO Listing', 'Issuance of Bonus Shares',
            'Issuance of Rights Issue', 'Employee Stock Options (ESOP) Planning', 'Patent', 'Trademark', 'Design Registration', 
            'DSC', 'Online Listing', 'Income Tax Return', 'GST, TDS, PF, ESI, PT, Customs', 'MCA & ROC Works', 
            'Appointment & Resignation of Directors', 'Annual Return', 'Company Registration', 'Udyog Aadhar & GST Registration', 
            'Importer-Exporter Code', 'Loan Proposal', 'CMA Data', 'Accounting', 'Subsidy', 'Tax Planning', 
            'Capital Re-Structuring', 'Project Report', 'TEV Study', 'Structured Finance', 
            'Preparation of Share and Warrants', 'Subscription Agreement (SWSA)', 'Preparation of Share Holders\' Agreement (SHA)', 
            'Due Diligence'
        ];

        // Dynamically create checkboxes for each category
        serviceCategories.forEach(category => {
            const checkboxDiv = document.createElement('div');
            checkboxDiv.classList.add('form-check'); // Add Bootstrap styling

            const checkbox = document.createElement('input');
            checkbox.classList.add('form-check-input');
            checkbox.type = 'checkbox';
            checkbox.name = 'other_guidance[]';
            checkbox.value = category;
            checkbox.id = category.replace(/\s+/g, '_').toLowerCase(); // Replace spaces with underscores for ID

            const label = document.createElement('label');
            label.classList.add('form-check-label');
            label.setAttribute('for', checkbox.id);
            label.textContent = category;

            // Append the checkbox and label to the div
            checkboxDiv.appendChild(checkbox);
            checkboxDiv.appendChild(label);

            // Append the div to the container
            otherGuidanceContainer.appendChild(checkboxDiv);
        });
    } else {
        // Hide the field if "Others" is unchecked
        otherField.style.display = 'none';
    }
}



    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('concerned_person_name');
        const designationField = document.getElementById('concerned_person_designation');
        const phoneField = document.getElementById('concerned_person_phone');
        const emailField = document.getElementById('email');

        if (document.getElementById('concerned_person_is_me').checked) {
            // Fill in with the logged-in user details if necessary (use appropriate server-side user details here)
            nameField.value = "<?php echo e(Auth::user()->name); ?>";
            emailField.value = "<?php echo e(Auth::user()->email); ?>";
            phoneField.value = "<?php echo e(Auth::user()->phone); ?>";
            designationField.value = "<?php echo e(Auth::user()->designation ?? ''); ?>";  // Assuming user model has these field

            nameField.readOnly = true;
            designationField.readOnly = false;
            phoneField.readOnly = true;
            emailField.readOnly = true;
        } else {
            nameField.value = '';
            emailField.value = '';
            phoneField.value = '';
            designationField.value = '';

            nameField.readOnly = false;
            designationField.readOnly = false;
            phoneField.readOnly = false;
            emailField.readOnly = false;
        }
    }
    
    function removePreviousInvestmentField(button) {
    const container = document.getElementById('previous-investments-container');
    const allRows = container.querySelectorAll('.previous-investment-row');

    if (allRows.length > 1) {
        button.closest('.previous-investment-row').remove();
    } else {
        alert('At least one entry is required.');
    }
}

    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/forms/investor_form.blade.php ENDPATH**/ ?>