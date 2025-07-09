 <!-- Assuming you have a layout file for including CSS, JS, etc. -->

<?php $__env->startSection('content'); ?>



<style>
    .form-floating>.form-control:focus, .form-floating>.form-control:not(:placeholder-shown) {
    padding-top: .625rem;
    padding-bottom: .625rem;
    
   
}

 .text-danger{
        font-size: 12px;
    }
   


</style>

<div class="container">

<div class="row justify-content-center mb-4">
   
</div> 
    
    <form class="bg-light p-4" id="investeeForm" action="<?php echo e(route('form.submit')); ?>" method="POST" enctype="multipart/form-data" style="box-shadow: 0 8px 40px 0 rgba(0,0,0,0.18), 0 1.5rem 3rem rgba(0,0,0,0.15);" novalidate>

    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-10 col-lg-22" style="max-width: 100%;">
            <div class="p-2 rounded-4 shadow-sm" style="background: linear-gradient(90deg,rgb(95, 185, 212) 0%, #e3ecef 100%);
                border-radius: 16px;
                box-shadow: 0 4px 40px rgba(0,0,0,0.08);
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center; width: 100%;">
                <div class="w-100">
                    <h2 class="fw-bold mb-1" style="color:rgb(27, 48, 55); letter-spacing: 1px;">Investee Form</h2>
                </div>
            </div>
        </div>
    </div> 
    <?php echo csrf_field(); ?>
    <!-- Company Details Section -->
    <!-- <div class="row g-3">
        <div class="col-sm-2">
            <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Company Details</h3>
        </div>

        <div class="col-sm-2">
            <label id="labelinput" for="company_name" class="required">Company Name <span style="color:red;">*</span></label>
            <input
                type="text"
                class="form-control spaced-input <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="company_name"
                name="company_name"
                value="<?php echo e(old('company_name')); ?>"
                required
            >
            <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-sm-2">
            <label id="labelinput" for="address" class="required">Address  <span style="color:red;">*</span></label>
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
                id="address"
                name="address"
                value="<?php echo e(old('address')); ?>"
                required
            >
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-sm-3">
            <label id="labelinput" for="nature_of_business" class="required">Nature of Business <span style="color:red;">*</span></label>
            <input
                list="business-options"
                class="form-control spaced-input <?php $__errorArgs = ['nature_of_business'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="nature_of_business"
                name="nature_of_business"
                value="<?php echo e(old('nature_of_business')); ?>"
                required
            >
            <datalist id="business-options">
                
                <option value="Accounting">Accounting</option>
                <option value="Airlines/Aviation">Airlines/Aviation</option>
                <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                <option value="Alternative Medicine">Alternative Medicine</option>
                <option value="Animation">Animation</option>
                <option value="Apparel/Fashion">Apparel/Fashion</option>
                <option value="Architecture/Planning">Architecture/Planning</option>
                <option value="Arts/Crafts">Arts/Crafts</option>
                <option value="Automotive">Automotive</option>
                <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                <option value="Banking/Mortgage">Banking/Mortgage</option>
                <option value="Biotechnology/Greentech">Biotechnology/Greentech</option>
                <option value="Broadcast Media">Broadcast Media</option>
                <option value="Building Materials">Building Materials</option>
                <option value="Business Supplies/Equipment">Business Supplies/Equipment</option>
                <option value="Capital Markets/Hedge Fund/Private Equity">Capital Markets/Hedge Fund/Private Equity</option>
                <option value="Chemicals">Chemicals</option>
                <option value="Civic/Social Organization">Civic/Social Organization</option>
                <option value="Civil Engineering">Civil Engineering</option>
                <option value="Commercial Real Estate">Commercial Real Estate</option>
                <option value="Computer Games">Computer Games</option>
                <option value="Computer Hardware">Computer Hardware</option>
                <option value="Computer Networking">Computer Networking</option>
                <option value="Computer Software/Engineering">Computer Software/Engineering</option>
                <option value="Computer/Network Security">Computer/Network Security</option>
                <option value="Construction">Construction</option>
                <option value="Consumer Electronics">Consumer Electronics</option>
                <option value="Consumer Goods">Consumer Goods</option>
                <option value="Consumer Services">Consumer Services</option>
                <option value="Cosmetics">Cosmetics</option>
                <option value="Dairy">Dairy</option>
                <option value="Defense/Space">Defense/Space</option>
                <option value="Design">Design</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Education Management">Education Management</option>
                <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                <option value="Entertainment/Movie Production">Entertainment/Movie Production</option>
                <option value="Environmental Services">Environmental Services</option>
                <option value="Events Services">Events Services</option>
                <option value="Executive Office">Executive Office</option>
                <option value="Facilities Services">Facilities Services</option>
                <option value="Farming">Farming</option>
                <option value="Financial Services">Financial Services</option>
                <option value="Fine Art">Fine Art</option>
                <option value="Fishery">Fishery</option>
                <option value="Food Production">Food Production</option>
                <option value="Food/Beverages">Food/Beverages</option>
                <option value="Fundraising">Fundraising</option>
                <option value="Furniture">Furniture</option>
                <option value="Gambling/Casinos">Gambling/Casinos</option>
                <option value="Glass/Ceramics/Concrete">Glass/Ceramics/Concrete</option>
                <option value="Government Administration">Government Administration</option>
                <option value="Government Relations">Government Relations</option>
                <option value="Graphic Design/Web Design">Graphic Design/Web Design</option>
                <option value="Health/Fitness">Health/Fitness</option>
                <option value="Higher Education/Acadamia">Higher Education/Acadamia</option>
                <option value="Hospital/Health Care">Hospital/Health Care</option>
                <option value="Hospitality">Hospitality</option>
                <option value="Human Resources/HR">Human Resources/HR</option>
                <option value="Import/Export">Import/Export</option>
                <option value="Individual/Family Services">Individual/Family Services</option>
                <option value="Industrial Automation">Industrial Automation</option>
                <option value="Information Services">Information Services</option>
                <option value="Information Technology/IT">Information Technology/IT</option>
                <option value="Insurance">Insurance</option>
                <option value="International Affairs">International Affairs</option>
                <option value="International Trade/Development">International Trade/Development</option>
                <option value="Internet">Internet</option>
                <option value="Investment Banking/Venture">Investment Banking/Venture</option>
                <option value="Investment Management/Hedge Fund/Private Equity">Investment Management/Hedge Fund/Private Equity</option>
                <option value="Judiciary">Judiciary</option>
                <option value="Law Enforcement">Law Enforcement</option>
                <option value="Law Practice/Law Firms">Law Practice/Law Firms</option>
                <option value="Legal Services">Legal Services</option>
                <option value="Legislative Office">Legislative Office</option>
                <option value="Leisure/Travel">Leisure/Travel</option>
                <option value="Library">Library</option>
                <option value="Logistics/Procurement">Logistics/Procurement</option>
                <option value="Luxury Goods/Jewelry">Luxury Goods/Jewelry</option>
                <option value="Machinery">Machinery</option>
                <option value="Management Consulting">Management Consulting</option>
                <option value="Maritime">Maritime</option>
                <option value="Market Research">Market Research</option>
                <option value="Marketing/Advertising/Sales">Marketing/Advertising/Sales</option>
                <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                <option value="Media Production">Media Production</option>
                <option value="Medical Equipment">Medical Equipment</option>
                <option value="Medical Practice">Medical Practice</option>
                <option value="Mental Health Care">Mental Health Care</option>
                <option value="Military Industry">Military Industry</option>
                <option value="Mining/Metals">Mining/Metals</option>
                <option value="Motion Pictures/Film">Motion Pictures/Film</option>
                <option value="Museums/Institutions">Museums/Institutions</option>
                <option value="Music">Music</option>
                <option value="Nanotechnology">Nanotechnology</option>
                <option value="Newspapers/Journalism">Newspapers/Journalism</option>
                <option value="Non-Profit/Volunteering">Non-Profit/Volunteering</option>
                <option value="Oil/Energy/Solar/Greentech">Oil/Energy/Solar/Greentech</option>
                <option value="Online Publishing">Online Publishing</option>
                <option value="Other Industry">Other Industry</option>
                <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                <option value="Packaging/Containers">Packaging/Containers</option>
                <option value="Paper/Forest Products">Paper/Forest Products</option>
                <option value="Performing Arts">Performing Arts</option>
                <option value="Pharmaceuticals">Pharmaceuticals</option>
                <option value="Philanthropy">Philanthropy</option>
                <option value="Photography">Photography</option>
                <option value="Plastics">Plastics</option>
                <option value="Political Organization">Political Organization</option>
                <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                <option value="Printing">Printing</option>
                <option value="Professional Training">Professional Training</option>
                <option value="Program Development">Program Development</option>
                <option value="Public Relations/PR">Public Relations/PR</option>
                <option value="Public Safety">Public Safety</option>
                <option value="Publishing Industry">Publishing Industry</option>
                <option value="Railroad Manufacture">Railroad Manufacture</option>
                <option value="Ranching">Ranching</option>
                <option value="Real Estate/Mortgage">Real Estate/Mortgage</option>
                <option value="Recreational Facilities/Services">Recreational Facilities/Services</option>
                <option value="Religious Institutions">Religious Institutions</option>
                <option value="Renewables/Environment">Renewables/Environment</option>
                <option value="Research Industry">Research Industry</option>
                <option value="Restaurants">Restaurants</option>
                <option value="Retail Industry">Retail Industry</option>
                <option value="Security/Investigations">Security/Investigations</option>
                <option value="Semiconductors">Semiconductors</option>
                <option value="Shipbuilding">Shipbuilding</option>
                <option value="Sporting Goods">Sporting Goods</option>
                <option value="Sports">Sports</option>
                <option value="Staffing/Recruiting">Staffing/Recruiting</option>
                <option value="Supermarkets">Supermarkets</option>
                <option value="Telecommunications">Telecommunications</option>
                <option value="Textiles">Textiles</option>
                <option value="Think Tanks">Think Tanks</option>
                <option value="Tobacco">Tobacco</option>
                <option value="Translation/Localization">Translation/Localization</option>
                <option value="Transportation">Transportation</option>
                <option value="Utilities">Utilities</option>
                <option value="Venture Capital/VC">Venture Capital/VC</option>
                <option value="Veterinary">Veterinary</option>
                <option value="Warehousing">Warehousing</option>
                <option value="Wholesale">Wholesale</option>
                <option value="Wine/Spirits">Wine/Spirits</option>
                <option value="Wireless">Wireless</option>
                <option value="Writing/Editing">Writing/Editing</option>
                
            </datalist>
            <?php $__errorArgs = ['nature_of_business'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-sm-3">
            <label id="labelinput" for="incorporated_in" class="required">Incorporated In <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control spaced-input <?php $__errorArgs = ['incorporated_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="incorporated_in" 
                name="incorporated_in" 
                value="<?php echo e(old('incorporated_in')); ?>" 
                required
            >
            <?php $__errorArgs = ['incorporated_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div> -->
















    <div class="row g-4 mb-4">
        <div class="col-12">
            <h3 class="text-dark fw-semibold fs-4 border-bottom pb-2">Company Details</h3>
        </div>

        <div class="col-md-3">
            <label for="company_name" class="form-label fw-medium">Company Name <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control shadow-sm rounded-3 <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="company_name"
                name="company_name"
                value="<?php echo e(old('company_name')); ?>"
                required
                pattern="^[A-Za-z\s\.\-&']+$"
                title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
               
            >
            <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-3">
            <label for="address" class="form-label fw-medium">Address <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control shadow-sm rounded-3 <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="address"
                name="address"
                value="<?php echo e(old('address')); ?>"
                required
            >
            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-3">
            <label for="nature_of_business" class="form-label fw-medium">Nature of Business <span class="text-danger">*</span></label>
            <input
                list="business-options"
                class="form-control shadow-sm rounded-3 <?php $__errorArgs = ['nature_of_business'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="nature_of_business"
                name="nature_of_business"
                value="<?php echo e(old('nature_of_business')); ?>"
                required
            >
            <?php $__errorArgs = ['nature_of_business'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <datalist id="business-options">
                
                <option value="Accounting">Accounting</option>
                <option value="Airlines/Aviation">Airlines/Aviation</option>
                <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                <option value="Alternative Medicine">Alternative Medicine</option>
                <option value="Animation">Animation</option>
                <option value="Apparel/Fashion">Apparel/Fashion</option>
                <option value="Architecture/Planning">Architecture/Planning</option>
                <option value="Arts/Crafts">Arts/Crafts</option>
                <option value="Automotive">Automotive</option>
                <option value="Aviation/Aerospace">Aviation/Aerospace</option>
                <option value="Banking/Mortgage">Banking/Mortgage</option>
                <option value="Biotechnology/Greentech">Biotechnology/Greentech</option>
                <option value="Broadcast Media">Broadcast Media</option>
                <option value="Building Materials">Building Materials</option>
                <option value="Business Supplies/Equipment">Business Supplies/Equipment</option>
                <option value="Capital Markets/Hedge Fund/Private Equity">Capital Markets/Hedge Fund/Private Equity</option>
                <option value="Chemicals">Chemicals</option>
                <option value="Civic/Social Organization">Civic/Social Organization</option>
                <option value="Civil Engineering">Civil Engineering</option>
                <option value="Commercial Real Estate">Commercial Real Estate</option>
                <option value="Computer Games">Computer Games</option>
                <option value="Computer Hardware">Computer Hardware</option>
                <option value="Computer Networking">Computer Networking</option>
                <option value="Computer Software/Engineering">Computer Software/Engineering</option>
                <option value="Computer/Network Security">Computer/Network Security</option>
                <option value="Construction">Construction</option>
                <option value="Consumer Electronics">Consumer Electronics</option>
                <option value="Consumer Goods">Consumer Goods</option>
                <option value="Consumer Services">Consumer Services</option>
                <option value="Cosmetics">Cosmetics</option>
                <option value="Dairy">Dairy</option>
                <option value="Defense/Space">Defense/Space</option>
                <option value="Design">Design</option>
                <option value="E-Learning">E-Learning</option>
                <option value="Education Management">Education Management</option>
                <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                <option value="Entertainment/Movie Production">Entertainment/Movie Production</option>
                <option value="Environmental Services">Environmental Services</option>
                <option value="Events Services">Events Services</option>
                <option value="Executive Office">Executive Office</option>
                <option value="Facilities Services">Facilities Services</option>
                <option value="Farming">Farming</option>
                <option value="Financial Services">Financial Services</option>
                <option value="Fine Art">Fine Art</option>
                <option value="Fishery">Fishery</option>
                <option value="Food Production">Food Production</option>
                <option value="Food/Beverages">Food/Beverages</option>
                <option value="Fundraising">Fundraising</option>
                <option value="Furniture">Furniture</option>
                <option value="Gambling/Casinos">Gambling/Casinos</option>
                <option value="Glass/Ceramics/Concrete">Glass/Ceramics/Concrete</option>
                <option value="Government Administration">Government Administration</option>
                <option value="Government Relations">Government Relations</option>
                <option value="Graphic Design/Web Design">Graphic Design/Web Design</option>
                <option value="Health/Fitness">Health/Fitness</option>
                <option value="Higher Education/Acadamia">Higher Education/Acadamia</option>
                <option value="Hospital/Health Care">Hospital/Health Care</option>
                <option value="Hospitality">Hospitality</option>
                <option value="Human Resources/HR">Human Resources/HR</option>
                <option value="Import/Export">Import/Export</option>
                <option value="Individual/Family Services">Individual/Family Services</option>
                <option value="Industrial Automation">Industrial Automation</option>
                <option value="Information Services">Information Services</option>
                <option value="Information Technology/IT">Information Technology/IT</option>
                <option value="Insurance">Insurance</option>
                <option value="International Affairs">International Affairs</option>
                <option value="International Trade/Development">International Trade/Development</option>
                <option value="Internet">Internet</option>
                <option value="Investment Banking/Venture">Investment Banking/Venture</option>
                <option value="Investment Management/Hedge Fund/Private Equity">Investment Management/Hedge Fund/Private Equity</option>
                <option value="Judiciary">Judiciary</option>
                <option value="Law Enforcement">Law Enforcement</option>
                <option value="Law Practice/Law Firms">Law Practice/Law Firms</option>
                <option value="Legal Services">Legal Services</option>
                <option value="Legislative Office">Legislative Office</option>
                <option value="Leisure/Travel">Leisure/Travel</option>
                <option value="Library">Library</option>
                <option value="Logistics/Procurement">Logistics/Procurement</option>
                <option value="Luxury Goods/Jewelry">Luxury Goods/Jewelry</option>
                <option value="Machinery">Machinery</option>
                <option value="Management Consulting">Management Consulting</option>
                <option value="Maritime">Maritime</option>
                <option value="Market Research">Market Research</option>
                <option value="Marketing/Advertising/Sales">Marketing/Advertising/Sales</option>
                <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                <option value="Media Production">Media Production</option>
                <option value="Medical Equipment">Medical Equipment</option>
                <option value="Medical Practice">Medical Practice</option>
                <option value="Mental Health Care">Mental Health Care</option>
                <option value="Military Industry">Military Industry</option>
                <option value="Mining/Metals">Mining/Metals</option>
                <option value="Motion Pictures/Film">Motion Pictures/Film</option>
                <option value="Museums/Institutions">Museums/Institutions</option>
                <option value="Music">Music</option>
                <option value="Nanotechnology">Nanotechnology</option>
                <option value="Newspapers/Journalism">Newspapers/Journalism</option>
                <option value="Non-Profit/Volunteering">Non-Profit/Volunteering</option>
                <option value="Oil/Energy/Solar/Greentech">Oil/Energy/Solar/Greentech</option>
                <option value="Online Publishing">Online Publishing</option>
                <option value="Other Industry">Other Industry</option>
                <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                <option value="Packaging/Containers">Packaging/Containers</option>
                <option value="Paper/Forest Products">Paper/Forest Products</option>
                <option value="Performing Arts">Performing Arts</option>
                <option value="Pharmaceuticals">Pharmaceuticals</option>
                <option value="Philanthropy">Philanthropy</option>
                <option value="Photography">Photography</option>
                <option value="Plastics">Plastics</option>
                <option value="Political Organization">Political Organization</option>
                <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                <option value="Printing">Printing</option>
                <option value="Professional Training">Professional Training</option>
                <option value="Program Development">Program Development</option>
                <option value="Public Relations/PR">Public Relations/PR</option>
                <option value="Public Safety">Public Safety</option>
                <option value="Publishing Industry">Publishing Industry</option>
                <option value="Railroad Manufacture">Railroad Manufacture</option>
                <option value="Ranching">Ranching</option>
                <option value="Real Estate/Mortgage">Real Estate/Mortgage</option>
                <option value="Recreational Facilities/Services">Recreational Facilities/Services</option>
                <option value="Religious Institutions">Religious Institutions</option>
                <option value="Renewables/Environment">Renewables/Environment</option>
                <option value="Research Industry">Research Industry</option>
                <option value="Restaurants">Restaurants</option>
                <option value="Retail Industry">Retail Industry</option>
                <option value="Security/Investigations">Security/Investigations</option>
                <option value="Semiconductors">Semiconductors</option>
                <option value="Shipbuilding">Shipbuilding</option>
                <option value="Sporting Goods">Sporting Goods</option>
                <option value="Sports">Sports</option>
                <option value="Staffing/Recruiting">Staffing/Recruiting</option>
                <option value="Supermarkets">Supermarkets</option>
                <option value="Telecommunications">Telecommunications</option>
                <option value="Textiles">Textiles</option>
                <option value="Think Tanks">Think Tanks</option>
                <option value="Tobacco">Tobacco</option>
                <option value="Translation/Localization">Translation/Localization</option>
                <option value="Transportation">Transportation</option>
                <option value="Utilities">Utilities</option>
                <option value="Venture Capital/VC">Venture Capital/VC</option>
                <option value="Veterinary">Veterinary</option>
                <option value="Warehousing">Warehousing</option>
                <option value="Wholesale">Wholesale</option>
                <option value="Wine/Spirits">Wine/Spirits</option>
                <option value="Wireless">Wireless</option>
                <option value="Writing/Editing">Writing/Editing</option>
                
            </datalist>
        </div>

       <div class="col-sm-3">
            <label for="incorporated_in" class="form-label">
                Incorporated In <span class="text-danger">*</span>
            </label>
            <!-- <input 
                type="number" 
                class="form-control" 
                id="incorporated_in" 
                name="incorporated_in" 
                step="1"
                min="1800"
                max="<?php echo e(date('Y')); ?>"
                required
                value="<?php echo e(old('incorporated_in')); ?>"
                oninput="validateYear()"
            >
            <div id="incorporated_in_error" class="text-danger mt-1 small"></div> -->
            <!-- Select dropdown option for incorporated in -->
            <select 
                class="form-select shadow-sm rounded-3 <?php $__errorArgs = ['incorporated_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="incorporated_in" 
                name="incorporated_in" 
                required
                aria-describedby="incorporated_in_error"
            >
                <option value="" disabled selected>Select Year</option>
                <?php for($year = date('Y'); $year >= 1901; $year--): ?>
                    <option value="<?php echo e($year); ?>" <?php echo e(old('incorporated_in') == $year ? 'selected' : ''); ?>>
                        <?php echo e($year); ?>

                    </option>
                <?php endfor; ?>
            </select>
            <?php $__errorArgs = ['incorporated_in'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback d-block small">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

    </div>


    






























    <!-- <hr> -->

    <!-- Concerned Person Details Section d -->
    <!-- <div class="row g-3 mb-1">
        <div class="col-sm-2">
            <h3 class="mt-2" style="font-size: 12px; font-weight: 600;">Concerned Person Details</h3>
            <div class="mt-1">
                <input 
                    type="checkbox" 
                    class="form-check-input" 
                    id="concerned_person_is_me" 
                    name="concerned_person_is_me"
                    value="1" 
                
                    <?php echo e(old('concerned_person_is_me') ? 'checked':''); ?>

                    onclick="fillConcernedPersonDetails()"
                >
                <label 
                    class="form-check-label" 
                    for="concerned_person_is_me" 
                    style="color: red; font-size: 12px;"
                >
                    Same as registered
                </label>
            </div>
        </div>

        <div class="col-sm-2">
            <label id="labelinput" for="concerned_person_name" class="required">Concerned Person <span style="color:red;">*</span></label>
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
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-2">
            <label id="labelinput" for="concerned_person_designation" class="required">Designation <span style="color:red;">*</span></label>
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
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-3">
            <label id="labelinput" for="concerned_person_email" class="required">Email <span style="color:red;">*</span></label>
            <input 
                type="email" 
                class="form-control spaced-input <?php $__errorArgs = ['concerned_person_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="concerned_person_email" 
                name="concerned_person_email" 
                value="<?php echo e(old('concerned_person_email')); ?>" 
                required
            >
            <?php $__errorArgs = ['concerned_person_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-3">
            <label id="labelinput" for="concerned_person_phone" class="phone required">Phone <span style="color:red;">*</span></label>
            <input 
                type="number" 
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
                value="<?php echo e(old('concerned_person_phone')); ?>" 
                required 
                maxlength="10" 
                oninput="this.value=this.value.slice(0, 10)"
            >
            <?php $__errorArgs = ['concerned_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div> -->










    <div class="card p-3 rounded-3 shadow-sm mb-4">
        <h5 class="mb-3 text-dark fw-semibold" style="font-size: 14px;">Concerned Person Details</h5>
        <div class="row g-4 align-items-end">

            <div class="col-sm-2">
                <div class="form-check mb-1">
                    <input 
                        type="checkbox" 
                        class="form-check-input rounded-sm" 
                        id="concerned_person_is_me" 
                        name="concerned_person_is_me" 
                        value="1"
                        <?php echo e(old('concerned_person_is_me') ? 'checked' : ''); ?>

                        onclick="fillConcernedPersonDetails()"
                    >
                    <label class="form-check-label text-danger small" for="concerned_person_is_me" style="font-size: 12px; color: red;">
                        Same as registered person
                    </label>
                </div>
            </div>

            <div class="col-sm-2">
                <label for="concerned_person_name" class="form-label small fw-semibold text-muted">Concerned Person <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control form-control-sm <?php $__errorArgs = ['concerned_person_name'];
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
                    pattern="^[A-Za-z\s\.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
                    
                >
                <?php $__errorArgs = ['concerned_person_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block small">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-sm-2">
                <label for="concerned_person_designation" class="form-label small fw-semibold text-muted">Designation <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control form-control-sm <?php $__errorArgs = ['concerned_person_designation'];
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
                    pattern="^[A-Za-z\s\.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
                   
                >
                <?php $__errorArgs = ['concerned_person_designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block small">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-3">
                <label for="concerned_person_email" class="form-label small fw-semibold text-muted">
                    Email <span class="text-danger">*</span>
                    <?php $__errorArgs = ['concerned_person_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger ms-2 small"><?php echo e($message ?: 'This Field is Required'); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <div id="concerned_person_email_error" class="text-danger small"></div>
                <input 
                    type="email" 
                    class="form-control form-control-sm <?php $__errorArgs = ['concerned_person_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    id="concerned_person_email" 
                    name="concerned_person_email" 
                    value="<?php echo e(old('concerned_person_email')); ?>" 
                    required
                >
            </div>

            <div class="col-md-3">
                <label for="concerned_person_phone" class="form-label small fw-semibold text-muted">Phone <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control form-control-sm <?php $__errorArgs = ['concerned_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    id="concerned_person_phone" 
                    name="concerned_person_phone" 
                    value="<?php echo e(old('concerned_person_phone')); ?>" 
                    maxlength="20" 
                    pattern="^\+?[0-9]{7,20}$" 
                    oninput="this.value = this.value.replace(/(?!^\+)[^0-9]/g, '')" 
                    required
                >

                <?php $__errorArgs = ['concerned_person_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback d-block small">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
        </div>
    </div>



















































    <!-- <hr> -->

    <!-- Company Links Section -->
                    
    <!-- <div class="row g-3">
        <div class="col-sm-2">
            <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Company Links</h3>
        </div>
        <div class="col-md-5">
            <label id="labelinput" for="company_website" class="required">Company Website <span style="color:red;">*</span></label>
            <input 
                type="url" 
                class="form-control spaced-input <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="company_website" 
                name="website" 
                value="<?php echo e(old('website')); ?>" 
                required
            >
            <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-5">
            <label id="labelinput" for="linkedin_link">LinkedIn <span style="color:red;">*</span></label>
            <input 
                type="url" 
                class="form-control spaced-input <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="linkedin_link" 
                name="linkedin" 
                value="<?php echo e(old('linkedin')); ?>" 
                required
            >
            <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        </div>
        <div class="row g-3 mt-1">
        <div class="col-sm-2">
            <h3 class="mt-2" style="font-size: 22px; font-weight: 600;">Other Links</h3>
        </div>
        <div class="col-sm-10" id="public-links-container">
            <div class="input-group mb-3">
                <input 
                    class="form-control spaced-input <?php $__errorArgs = ['public_links.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    type="url" 
                    name="public_links[]" 
                    placeholder="URL" 
                    value="<?php echo e(old('public_links.0')); ?>"
                >
                
                <select 
                    class="form-control spaced-input <?php $__errorArgs = ['link_descriptions.0'];
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
                    <option value="" disabled <?php echo e(old('link_descriptions.0') ? '' : 'selected'); ?>>Select Account</option>
                    <option value="Facebook" <?php echo e(old('link_descriptions.0') == 'Facebook' ? 'selected' : ''); ?>>Facebook</option>
                    <option value="Twitter" <?php echo e(old('link_descriptions.0') == 'Twitter' ? 'selected' : ''); ?>>Twitter</option>
                    <option value="Others" <?php echo e(old('link_descriptions.0') == 'Others' ? 'selected' : ''); ?>>Others</option>
                </select>
                
                <button 
                    class="btn btn-info float-end" 
                    style="margin-right: 8px;" 
                    type="button" 
                    onclick="addPublicLinkField()"
                >
                    + Add More Links
                </button>
            </div>
            <?php $__errorArgs = ['public_links.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div> -->



























    <div class="row g-3 mb-4">
        <!-- Company Links Section -->
        <div class="col-sm-2">
            <h3 class="mt-3" style="font-size: 16px; font-weight: 600;">Company Links</h3>
        </div>

        <div class="col-md-5">
            <label for="company_website" class="form-label required">Company Website <span class="text-danger">*</span></label>
          
            <input 
                type="url" 
                class="form-control <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="company_website" 
                name="website" 
                value="<?php echo e(old('website')); ?>" 
                required
                pattern="^(https?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?$"
                title="Please enter a valid website URL (e.g., https://example.com)"
                placeholder="https://example.com"
            >

              <div id="company_website_error" class="text-danger small"></div>
            <?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-5">
            <label for="linkedin_link" class="form-label required">LinkedIn <span class="text-danger">*</span></label>
           
            <input 
                type="url" 
                class="form-control <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                id="linkedin_link" 
                name="linkedin" 
                value="<?php echo e(old('linkedin')); ?>" 
                required
                placeholder="https://www.linkedin.com/in/username"
            >
             <div id="linkedin_link_error" class="text-danger small"></div>
            <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">This Field is Required</div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <!-- Other Links Section -->
        <div class="col-sm-2">
            <h3 class="mt-3" style="font-size: 16px; font-weight: 600;">Other Links</h3>
        </div>

        <div class="col-sm-10" id="public-links-container">
            <div class="row g-0 mb-3">
                <div class="col-sm-5">
                    <input 
                        class="form-control <?php $__errorArgs = ['public_links.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        type="url" 
                        name="public_links[]" 
                        placeholder="URL" 
                        value="<?php echo e(old('public_links.0')); ?>"
                        
                    >
                    <?php $__errorArgs = ['public_links.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">This Field is Required</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-sm-5">
                    <select 
                        class="form-control <?php $__errorArgs = ['link_descriptions.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                        name="link_descriptions[]" 
                       
                    >
                        <option value="" disabled <?php echo e(old('link_descriptions.0') ? '' : 'selected'); ?>>Select Account</option>
                        <option value="Facebook" <?php echo e(old('link_descriptions.0') == 'Facebook' ? 'selected' : ''); ?>>Facebook</option>
                        <option value="Twitter/X" <?php echo e(old('link_descriptions.0') == 'Twitter/X' ? 'selected' : ''); ?>>Twitter/X</option>
                        <option value="Others" <?php echo e(old('link_descriptions.0') == 'Others' ? 'selected' : ''); ?>>Others</option>
                    </select>
                    <?php $__errorArgs = ['link_descriptions.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback d-block">This Field is Required</div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-sm-2 text-end">
                    <button 
                        class="btn btn-outline-primary" 
                        type="button" 
                        onclick="addPublicLinkField()"
                    >
                        + Add More Links
                    </button>
                </div>
            </div>
            <!-- Dynamically added rows will appear here -->
        </div>
    </div>






    



































    <!-- <hr> -->
    <!-- Founder Details Section -->
    <!-- <div id="founder-details-container" class="row g-1">
        <div class="col-sm-2">
            <h3 class="mt-4" style="font-size: 22px; font-weight: 600;">Founder Details</h3>
        </div>

        <div class="col-md-2">
            <label id="labelinput" for="founder_name" class="required">Name <span style="color:red;">*</span></label>
            <input 
                type="text" 
                class="form-control <?php $__errorArgs = ['founder_name.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="founder_name[]" 
                value="<?php echo e(old('founder_name.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['founder_name.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="founder_position" class="required">Position</label>
            <select 
                class="form-control <?php $__errorArgs = ['founder_position.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="founder_position[]" 
                required
            >
                    <option value="" disabled selected>Select Position <span style="color:red;"></span></option>
                    <option value="Chief Administrative Officer">Chief Administrative Officer</option>
                            <option value="Chief Analytics Officer">Chief Analytics Officer</option>
                            <option value="Chief Brand Officer">Chief Brand Officer</option>
                            <option value="Chief Business Development Officer">Chief Business Development Officer</option>
                            <option value="Chief Business Officer">Chief Business Officer</option>
                            <option value="Chief Commercial Officer">Chief Commercial Officer</option>
                            <option value="Chief Communications Officer">Chief Communications Officer</option>
                            <option value="Chief Compliance Officer">Chief Compliance Officer</option>
                            <option value="Chief Content Officer">Chief Content Officer</option>
                            <option value="Chief Creative Officer">Chief Creative Officer</option>
                            <option value="Chief Customer Officer">Chief Customer Officer</option>
                            <option value="Chief Data Officer">Chief Data Officer</option>
                            <option value="Chief Design Officer">Chief Design Officer</option>
                            <option value="Chief Digital Officer">Chief Digital Officer</option>
                            <option value="Chief Diversity Officer">Chief Diversity Officer</option>
                            <option value="Chief Executive Officer">Chief Executive Officer</option>
                            <option value="Chief Experience Officer">Chief Experience Officer</option>
                            <option value="Chief Financial Officer">Chief Financial Officer</option>
                            <option value="Chief Gaming Officer">Chief Gaming Officer</option>
                            <option value="Chief Genealogical Officer">Chief Genealogical Officer</option>
                            <option value="Chief Human Resources Officer">Chief Human Resources Officer</option>
                            <option value="Chief Information Officer">Chief Information Officer</option>
                            <option value="Chief Information Officer (Higher Education)">Chief Information Officer (Higher Education)</option>
                            <option value="Chief Information Security Officer">Chief Information Security Officer</option>
                            <option value="Chief Innovation Officer">Chief Innovation Officer</option>
                            <option value="Chief Investment Officer">Chief Investment Officer</option>
                            <option value="Chief Knowledge Officer">Chief Knowledge Officer</option>
                            <option value="Chief Learning Officer">Chief Learning Officer</option>
                            <option value="Chief Marketing Officer">Chief Marketing Officer</option>
                            <option value="Chief Operating Officer">Chief Operating Officer</option>
                            <option value="Chief Privacy Officer">Chief Privacy Officer</option>
                            <option value="Chief Process Officer">Chief Process Officer</option>
                            <option value="Chief Product Officer">Chief Product Officer</option>
                            <option value="Chief Reputation Officer">Chief Reputation Officer</option>
                            <option value="Chief Research Officer">Chief Research Officer</option>
                            <option value="Chief Restructuring Officer">Chief Restructuring Officer</option>
                            <option value="Chief Risk Officer">Chief Risk Officer</option>
                            <option value="Chief Science Officer">Chief Science Officer</option>
                            <option value="Chief Scientific Officer">Chief Scientific Officer</option>
                            <option value="Chief Security Officer">Chief Security Officer</option>
                            <option value="Chief Services Officer">Chief Services Officer</option>
                            <option value="Chief Strategy Officer">Chief Strategy Officer</option>
                            <option value="Chief Sustainability Officer">Chief Sustainability Officer</option>
                            <option value="Chief Technology Officer">Chief Technology Officer</option>
                            <option value="Chief Visibility Officer">Chief Visibility Officer</option>
                            <option value="Chief Visionary Officer">Chief Visionary Officer</option>
                            <option value="Chief Web Officer">Chief Web Officer</option>
                            <option value="General Manager">General Manager</option>
                            <option value="Manager">Manager</option>
                            <option value="Others">Others</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Vice President">Vice President</option>
                  
                </select>
            <?php $__errorArgs = ['founder_position.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="founder_education" class="required">Highest Qualification <span style="color:red;">*</span></label>
            <input 
                type="text" 
                class="form-control <?php $__errorArgs = ['founder_education.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="founder_education[]" 
                value="<?php echo e(old('founder_education.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['founder_education.'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="founder_experience" class="required">Work Experience (In Years) <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control <?php $__errorArgs = ['founder_experience.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="founder_experience[]" 
                value="<?php echo e(old('founder_experience.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['founder_experience.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-1">
            <button class="btn btn-info float-end mt-4" type="button" onclick="addFounderField()">+</button>
        </div>
    </div> -->





























    <div id="founder-details-container" class="p-3 rounded-4 shadow-sm mb-4" style="background-color: #ffffff; border: 1px solid #e2e8f0;">
        <div class="row g-3 align-items-end">
            <div class="col-sm-12">
                <h3 class="fs-5 fw-semibold text-dark">Founder Details</h3>
            </div>

            <div class="col-md-2">
                <label id="labelinput" for="founder_name" class="required">Name <span style="color:red;">*</span></label>
                <input 
                    type="text" 
                    class="form-control <?php $__errorArgs = ['founder_name.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="founder_name[]" 
                    value="<?php echo e(old('founder_name.0')); ?>" 
                    required
                    pattern="^[A-Za-z\s\.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
                >
                <?php $__errorArgs = ['founder_name.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-2">
                <label id="labelinput" for="founder_position" class="required">Position</label>
                <select 
                    class="form-control <?php $__errorArgs = ['founder_position.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="founder_position[]" 
                    required
                >
                    <option value="" <?php echo e(old('founder_position.0') ?'' :'selected'); ?> disabled>Select Position</option>
                    <option value="Chief Administrative Officer" <?php echo e(old('founder_position.0') == 'Chief Administrative Officer' ? 'selected' : ''); ?>>Chief Administrative Officer</option>
                    <option value="Chief Analytics Officer" <?php echo e(old('founder_position.0')== 'Chief Analytics Officer' ? 'selected' : ''); ?>>Chief Analytics Officer</option>
                    <option value="Chief Brand Officer" <?php echo e(old('founder_position.0') == 'Chief Brand Officer' ? 'selected' : ''); ?>>Chief Brand Officer</option>
                    <option value="Chief Business Development Officer" <?php echo e(old('founder_position.0') == 'Chief Business Development Officer'? 'selected' : ''); ?>>Chief Business Development Officer</option>
                    <option value="Chief Business Officer" <?php echo e(old('founder_position.0') == 'Chief Business Officer' ? 'selected':''); ?>>Chief Business Officer</option>
                    <option value="Chief Commercial Officer" <?php echo e(old('founder_position.0') == 'Chief Commercial Officer' ? 'selected':''); ?>>Chief Commercial Officer</option>
                    <option value="Chief Communications Officer" <?php echo e(old('founder_position.0') == 'Chief Communications Officer' ? 'selected':''); ?>>Chief Communications Officer</option>
                    <option value="Chief Compliance Officer" <?php echo e(old('founder_position.0') == 'Chief Compliance Officer'? 'selected':''); ?>>Chief Compliance Officer</option>
                    <option value="Chief Content Officer" <?php echo e(old('founder_position.0')== 'Chief Content Officer'? 'selected':''); ?>>Chief Content Officer</option>
                    <option value="Chief Creative Officer" <?php echo e(old('founder_position.0') == 'Chief Creative Officer' ? 'selected':''); ?>>Chief Creative Officer</option>
                    <option value="Chief Customer Officer" <?php echo e(old('founder_position.0') == 'Chief Customer Officer' ? 'selected':''); ?>>Chief Customer Officer</option>
                    <option value="Chief Data Officer"<?php echo e(old('founder_position.0') == 'Chief Data Officer'? 'selected':''); ?>>Chief Data Officer</option>
                    <option value="Chief Design Officer" <?php echo e(old('founder_position.0') == 'Chief Design Officer'? 'selected':''); ?>>Chief Design Officer</option>
                    <option value="Chief Digital Officer" <?php echo e(old('founder_position.0') == 'Chief Digital Officer'? 'selected':''); ?>>Chief Digital Officer</option>
                    <option value="Chief Diversity Officer" <?php echo e(old('founder_position.0') == 'Chief Diversity Officer'? 'selected':''); ?>>Chief Diversity Officer</option>
                    <option value="Chief Executive Officer" <?php echo e(old('founder_position.0') == 'Chief Executive Officer'? 'selected':''); ?>>Chief Executive Officer</option>
                    <option value="Chief Experience Officer" <?php echo e(old('founder_position.0') == 'Chief Experience Officer'? 'selected':''); ?>>Chief Experience Officer</option>
                    <option value="Chief Financial Officer" <?php echo e(old('founder_position.0') == 'Chief Financial Officer'? 'selected':''); ?>>Chief Financial Officer</option>
                    <option value="Chief Gaming Officer" <?php echo e(old('founder_position.0') == 'Chief Gaming Officer'? 'selected':''); ?>>Chief Gaming Officer</option>
                    <option value="Chief Genealogical Officer" <?php echo e(old('founder_position.0') == 'Chief Genealogical Officer'? 'selected':''); ?>>Chief Genealogical Officer</option>
                    <option value="Chief Human Resources Officer" <?php echo e(old('founder_position.0') == 'Chief Human Resources Officer'? 'selected':''); ?>>Chief Human Resources Officer</option>
                    <option value="Chief Information Officer" <?php echo e(old('founder_position.0') == 'Chief Information Officer'? 'selected':''); ?>>Chief Information Officer</option>
                    <option value="Chief Information Officer (Higher Education)" <?php echo e(old('founder_position.0') == 'Chief Information Officer (Higher Education)'? 'selected':''); ?>>Chief Information Officer (Higher Education)</option>
                    <option value="Chief Information Security Officer" <?php echo e(old('founder_position.0') == 'Chief Information Security Officer'? 'selected':''); ?>>Chief Information Security Officer</option>
                    <option value="Chief Innovation Officer" <?php echo e(old('founder_position.0') == 'Chief Innovation Officer'? 'selected':''); ?>>Chief Innovation Officer</option>
                    <option value="Chief Investment Officer" <?php echo e(old('founder_position.0') == 'Chief Investment Officer'? 'selected':''); ?>>Chief Investment Officer</option>
                    <option value="Chief Knowledge Officer" <?php echo e(old('founder_position.0') == 'Chief Knowledge Officer'? 'selected':''); ?>>Chief Knowledge Officer</option>
                    <option value="Chief Learning Officer" <?php echo e(old('founder_position.0') == 'Chief Learning Officer'? 'selected':''); ?>>Chief Learning Officer</option>
                    <option value="Chief Marketing Officer" <?php echo e(old('founder_position.0') == 'Chief Marketing Officer'? 'selected':''); ?>>Chief Marketing Officer</option>
                    <option value="Chief Operating Officer" <?php echo e(old('founder_position.0') == 'Chief Operating Officer'? 'selected':''); ?>>Chief Operating Officer</option>
                    <option value="Chief Privacy Officer" <?php echo e(old('founder_position.0') == 'Chief Privacy Officer'? 'selected':''); ?>>Chief Privacy Officer</option>
                    <option value="Chief Process Officer" <?php echo e(old('founder_position.0') == 'Chief Process Officer'? 'selected':''); ?>>Chief Process Officer</option>
                    <option value="Chief Product Officer" <?php echo e(old('founder_position.0') == 'Chief Product Officer'? 'selected':''); ?>>Chief Product Officer</option>
                    <option value="Chief Reputation Officer" <?php echo e(old('founder_position.0') == 'Chief Reputation Officer'? 'selected':''); ?>>Chief Reputation Officer</option>
                    <option value="Chief Research Officer" <?php echo e(old('founder_position.0') == 'Chief Research Officer'? 'selected':''); ?>>Chief Research Officer</option>
                    <option value="Chief Restructuring Officer" <?php echo e(old('founder_position.0') == 'Chief Restructuring Officer'? 'selected':''); ?>>Chief Restructuring Officer</option>
                    <option value="Chief Risk Officer" <?php echo e(old('founder_position.0') == 'Chief Risk Officer'? 'selected':''); ?>>Chief Risk Officer</option>
                    <option value="Chief Science Officer" <?php echo e(old('founder_position.0') == 'Chief Science Officer'? 'selected':''); ?>>Chief Science Officer</option>
                    <option value="Chief Scientific Officer" <?php echo e(old('founder_position.0') == 'Chief Scientific Officer'? 'selected':''); ?>>Chief Scientific Officer</option>
                    <option value="Chief Security Officer" <?php echo e(old('founder_position.0') == 'Chief Security Officer'? 'selected':''); ?>>Chief Security Officer</option>
                    <option value="Chief Services Officer" <?php echo e(old('founder_position.0') == 'Chief Services Officer'? 'selected':''); ?>>Chief Services Officer</option>
                    <option value="Chief Strategy Officer" <?php echo e(old('founder_position.0') == 'Chief Strategy Officer'? 'selected':''); ?>>Chief Strategy Officer</option>
                    <option value="Chief Sustainability Officer" <?php echo e(old('founder_position.0') == 'Chief Sustainability Officer'? 'selected':''); ?>>Chief Sustainability Officer</option>
                    <option value="Chief Technology Officer" <?php echo e(old('founder_position.0') == 'Chief Technology Officer'? 'selected':''); ?>>Chief Technology Officer</option>
                    <option value="Chief Visibility Officer" <?php echo e(old('founder_position.0') == 'Chief Visibility Officer'? 'selected':''); ?>>Chief Visibility Officer</option>
                    <option value="Chief Visionary Officer" <?php echo e(old('founder_position.0') == 'Chief Visionary Officer'? 'selected':''); ?>>Chief Visionary Officer</option>
                    <option value="Chief Web Officer" <?php echo e(old('founder_position.0') == 'Chief Web Officer'? 'selected':''); ?>>Chief Web Officer</option>
                    <option value="General Manager" <?php echo e(old('founder_position.0') == 'General Manager'? 'selected':''); ?>>General Manager</option>
                    <option value="Manager" <?php echo e(old('founder_position.0') == 'Manager'? 'selected':''); ?>>Manager</option>
                    <option value="Others" <?php echo e(old('founder_position.0') == 'Others'? 'selected':''); ?>>Others</option>
                    <option value="Secretary" <?php echo e(old('founder_position.0') == 'Secretary'? 'selected':''); ?>>Secretary</option>
                    <option value="Supervisor" <?php echo e(old('founder_position.0') == 'Supervisor'? 'selected':''); ?>>Supervisor</option>
                    <option value="Vice President" <?php echo e(old('founder_position.0') == 'Vice President'? 'selected':''); ?>>Vice President</option>
                </select>
                <?php $__errorArgs = ['founder_position.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-2">
                <label id="labelinput" for="founder_education" class="required">Highest Qualification <span style="color:red;">*</span></label>
                <input 
                    type="text" 
                    class="form-control <?php $__errorArgs = ['founder_education.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="founder_education[]" 
                    value="<?php echo e(old('founder_education.0')); ?>" 
                    required
                    pattern="^[A-Za-z\s\.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
                   
                >
                <?php $__errorArgs = ['founder_education.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-3">
                <label id="labelinput" for="founder_experience" class="required">Work Experience (In Years) <span style="color:red;">*</span></label>
                <input 
                    type="number" 
                    class="form-control <?php $__errorArgs = ['founder_experience.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="founder_experience[]" 
                    value="<?php echo e(old('founder_experience.0')); ?>" 
                    step="0.1"       
                    min="0.1"
                    max="100"
                    oninput="if (this.value < 0.1) this.value = ''"
                    required
                >
                <?php $__errorArgs = ['founder_experience.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-1 text-end">
                <button 
                    class="btn btn-success mt-2" 
                    type="button" 
                    onclick="addFounderField()"
                    title="Add more founder"
                >
                    +
                </button>
            </div>
        </div>
    </div>









































    
    <hr>

     <!-- Requirements of Fund Section -->
   <div id="funds-container" class="mb-4">
    <div class="heading-with-hr">
        <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Requirements of Fund</h3>
        <!-- <hr> -->
    </div>
    <div class="row mb-3 align-items-end">
        <div class="col-md-3">
            <label id="labelinput" for="fund_usage" class="required">Usage of Fund <span style="color:red;">*</span></label>
            <select 
                class="form-control spaced-input <?php $__errorArgs = ['fund_usage.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="fund_usage[]" 
                required
            >
                <option value="" disabled <?php echo e(old('fund_usage.0') ? '' : 'selected'); ?>>Select Usage</option>
                <option value="Capex" <?php echo e(old('fund_usage.0') == 'Capex' ? 'selected' : ''); ?>>Capex</option>
                <option value="Opex" <?php echo e(old('fund_usage.0') == 'Opex' ? 'selected' : ''); ?>>Opex</option>
                <option value="Acquisition" <?php echo e(old('fund_usage.0') == 'Acquisition' ? 'selected' : ''); ?>>Acquisition</option>
                <option value="Debt Requirement" <?php echo e(old('fund_usage.0') == 'Debt Requirement' ? 'selected' : ''); ?>>Debt Requirement</option>
                <option value="Others" <?php echo e(old('fund_usage.0') == 'Others' ? 'selected' : ''); ?>>Others</option>
            </select>
            <?php $__errorArgs = ['fund_usage.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger d-block">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-8">
            <label id="labelinput" for="fund_requirement" class="required">Fund Requirement <span style="color:red;">*</span></label>
            <div class="input-group">
                <input 
                    class="form-control spaced-input <?php $__errorArgs = ['fund_requirement.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    type="number" 
                    name="fund_requirement[]" 
                    value="<?php echo e(old('fund_requirement.0')); ?>" 
                    min="1"
                    step="0.01"
                    required
                    oninput="if (this.value < 1) this.value = ''"
                >
                
                <select 
                    class="form-select spaced-input <?php $__errorArgs = ['fund_unit.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="fund_unit[]" 
                    required
                >
                    <option value="crores" <?php echo e(old('fund_unit.0') == 'crores' ? 'selected' : ''); ?>>Cr</option>
                    <option value="lakhs" <?php echo e(old('fund_unit.0') == 'lakhs' ? 'selected' : ''); ?>>Lakh</option>
                </select>
               
            </div>
           
        </div>
         

        <div class="col-md-1 mt-3">
            <button id="addfundButton" class="btn btn-info float-end" type="button" onclick="addFundField()">+ </button>
        </div>
       
           <?php $__errorArgs = ['fund_requirement.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger d-block mt-1">This Field is Required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <?php $__errorArgs = ['fund_unit.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger d-block mt-1">This Field is Required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>

    <div class="form-floating mb-1">
    <input 
        type="text" 
        class="form-control spaced-input" 
        id="total_fund_raised" 
        name="total_fund_raised" 
        value="<?php echo e(old('total_fund_raised')); ?>" 
        readonly
    >
    <label id="labelinput" for="fund_requirement" class="required">Total Fund Raised</label>
    </div>



























































































    
   <!-- <div id="previous-rounds-container" class="mb-4">
    <div class="row mb-3">
        <div class="heading-with-hr">
            <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Previous Rounds</h3>
          
        </div>
        <div class="col-md-2">
            <label id="labelinput" for="previous_rounds" class="required">Previous Round <span style="color:red;">*</span></label>
            <select 
                class="form-control spaced-input <?php $__errorArgs = ['previous_rounds.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="previous_rounds[]" 
                required
            >
                <option value="" disabled <?php echo e(old('previous_rounds.0') ? '' : 'selected'); ?>>Select Round</option>
                <option value="Pre seed round" <?php echo e(old('previous_rounds.0') == 'Pre seed round' ? 'selected' : ''); ?>>Pre seed round</option>
                <option value="Seed Round" <?php echo e(old('previous_rounds.0') == 'Seed Round' ? 'selected' : ''); ?>>Seed Round</option>
                <option value="Series A round" <?php echo e(old('previous_rounds.0') == 'Series A round' ? 'selected' : ''); ?>>Series A round</option>
                <option value="Series B round" <?php echo e(old('previous_rounds.0') == 'Series B round' ? 'selected' : ''); ?>>Series B round</option>
                <option value="Series C round" <?php echo e(old('previous_rounds.0') == 'Series C round' ? 'selected' : ''); ?>>Series C round</option>
                <option value="Series D round" <?php echo e(old('previous_rounds.0') == 'Series D round' ? 'selected' : ''); ?>>Series D round</option>
                <option value="Series E and beyond" <?php echo e(old('previous_rounds.0') == 'Series E and beyond' ? 'selected' : ''); ?>>Series E and beyond</option>
            </select>
            <?php $__errorArgs = ['previous_rounds.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="investors" class="required">Investors <span style="color:red;">*</span></label>
            <input 
                type="text" 
                class="form-control spaced-input <?php $__errorArgs = ['investors.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="investors[]" 
                value="<?php echo e(old('investors.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['investors.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="amount_raised" class="required">Amount Raised (in cr) <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control spaced-input <?php $__errorArgs = ['amount_raised.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="amount_raised[]" 
                min="0" 
                step="0.01" 
                value="<?php echo e(old('amount_raised.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['amount_raised.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-3">
            <label id="labelinput" for="valuation" class="required">Valuation (in cr) <span style="color:red;">*</span></label>
            <input 
                type="number" 
                class="form-control spaced-input <?php $__errorArgs = ['valuation.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                name="valuation[]" 
                value="<?php echo e(old('valuation.0')); ?>" 
                required
            >
            <?php $__errorArgs = ['valuation.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger">This Field is Required</span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-1">
            <button class="btn btn-info float-end mt-4" type="button" onclick="addPreviousRoundField()">+</button>
        </div>
    </div>
    </div> -->
    <!-- <hr> -->










































    <div id="previous-rounds-container" class="mb-4 p-4 bg-white rounded-lg border shadow-sm" style="border-radius: 10px;">
 
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="mb-1 fs-5 fw-semibold text-dark">Previous Rounds</h3>
            </div>
        </div>

    
        <div class="row mb-3">
            
            <div class="col-md-2">
                <label id="labelinput" for="previous_rounds" class="form-label required">Previous Round <span class="text-danger">*</span></label>
                <select 
                    class="form-select <?php $__errorArgs = ['previous_rounds.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="previous_rounds[]" 
                    required
                >
                    <option value="" disabled <?php echo e(old('previous_rounds.0') ? '' : 'selected'); ?>>Select Round</option>
                    <option value="Pre seed round" <?php echo e(old('previous_rounds.0') == 'Pre seed round' ? 'selected' : ''); ?>>Pre seed round</option>
                    <option value="Seed Round" <?php echo e(old('previous_rounds.0') == 'Seed Round' ? 'selected' : ''); ?>>Seed Round</option>
                    <option value="Series A round" <?php echo e(old('previous_rounds.0') == 'Series A round' ? 'selected' : ''); ?>>Series A round</option>
                    <option value="Series B round" <?php echo e(old('previous_rounds.0') == 'Series B round' ? 'selected' : ''); ?>>Series B round</option>
                    <option value="Series C round" <?php echo e(old('previous_rounds.0') == 'Series C round' ? 'selected' : ''); ?>>Series C round</option>
                    <option value="Series D round" <?php echo e(old('previous_rounds.0') == 'Series D round' ? 'selected' : ''); ?>>Series D round</option>
                    <option value="Series E and beyond" <?php echo e(old('previous_rounds.0') == 'Series E and beyond' ? 'selected' : ''); ?>>Series E and beyond</option>
                </select>
                <?php $__errorArgs = ['previous_rounds.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="col-md-3">
                <label id="labelinput" for="investors" class="form-label required">Investors <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    class="form-control <?php $__errorArgs = ['investors.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="investors[]" 
                    value="<?php echo e(old('investors.0')); ?>" 
                    required
                    pattern="^[A-Za-z\s\.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="this.value = this.value.replace(/[^A-Za-z\s.\-&']/g, '')"
                 
                >
                <?php $__errorArgs = ['investors.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

           
            <div class="col-md-3">
                <label id="labelinput" for="amount_raised" class="form-label required">Amount Raised (in cr) <span class="text-danger">*</span></label>
                <input 
                    type="number" 
                    class="form-control <?php $__errorArgs = ['amount_raised.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="amount_raised[]" 
                    min="0.01" 
                    step="0.01" 
                    oninput = "if (this.value < 0) this.value = ''"
                    value="<?php echo e(old('amount_raised.0')); ?>" 
                    required
                >
                <?php $__errorArgs = ['amount_raised.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

           
            <div class="col-md-3">
                <label id="labelinput" for="valuation" class="form-label required">Valuation (in cr) <span class="text-danger">*</span></label>
                <input 
                    type="number" 
                    class="form-control <?php $__errorArgs = ['valuation.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="valuation[]" 
                    value="<?php echo e(old('valuation.0')); ?>" 
                    min="0.01"
                    step="0.01"
                    oninput="if (this.value <= 0) this.value = ''"
                    required
                >
                <?php $__errorArgs = ['valuation.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="invalid-feedback">This Field is Required</div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

          
            <div class="col-md-1 mt-3">
                <button class="btn btn-info float-end" type="button" onclick="addPreviousRoundField()">+</button>
            </div>
        </div>
    </div>





















































    <!-- Attachments Section -->
    <div class="heading-with-hr">
    <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">Attachments</h3>
    <!-- <hr> -->
    </div>
    <div class="mb-1">
    <label id="labelinput" for="pitch_deck" class="required" style="color: red;">Pitch Deck<small> (ppt, pptx, pdf, doc, docx)</small> <span style="color:red;">*</span></label>
    <input 
        type="file" 
        class="form-control spaced-input <?php $__errorArgs = ['pitch_deck'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
        id="pitch_deck" 
        name="pitch_deck" 
        value="<?php echo e(old('pitch_deck.0')); ?>"
        accept=".ppt,.pptx,.pdf,.doc,.docx" 
        required
        onchange="validatePitchDeckFile(this)"
    >
    <div id="pitch_deck_error" class="text-danger"></div>
    <?php $__errorArgs = ['pitch_deck'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This Field is Required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <script>
    function validatePitchDeckFile(input) {
        const file = input.files[0];
        const errorDiv = document.getElementById('pitch_deck_error');
        if (!file) {
            errorDiv.textContent = '';
            return;
        }
        const allowedExtensions = /\.(ppt|pptx|pdf|doc|docx)$/i;
        if (!allowedExtensions.test(file.name)) {
            errorDiv.textContent = 'Invalid file type. Only ppt, pptx, pdf, doc, or docx files are allowed.';
            input.value = '';
        } else {
            errorDiv.textContent = '';
        }
    }
    </script>
    </div>
    <div class="mb-1">
    <label id="labelinput" for="financials" class="required" style="color:red;">Financials</label>
    <div id="financials-container">
        <div class="row mb-4 align-items-end">
            <div class="col-md-3">
                <label id="labelinput" for="fiscal_year" class="required">Fiscal Year<span style="color:red;">*</span></label>
                <select 
                    class="form-control spaced-input <?php $__errorArgs = ['fiscal_year.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="fiscal_year[]" 
                    required
                >
                    <option value="" disabled <?php echo e(old('fiscal_year.0') ? '' : 'selected'); ?>>Select Year</option>
                    <option value="2020" <?php echo e(old('fiscal_year.0') == '2020' ? 'selected' : ''); ?>>2020-2021</option>
                    <option value="2021" <?php echo e(old('fiscal_year.0') == '2021' ? 'selected' : ''); ?>>2021-2022</option>
                    <option value="2022" <?php echo e(old('fiscal_year.0') == '2022' ? 'selected' : ''); ?>>2022-2023</option>
                    <option value="2023" <?php echo e(old('fiscal_year.0') == '2023' ? 'selected' : ''); ?>>2023-2024</option>
                </select>
                <?php $__errorArgs = ['fiscal_year.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="financials" class="required">Choose file<small> (pdf, doc, docx, xls, xlsx)</small> <span style="color:red;">*</span></label>
                <!-- Add this after your input field -->
                 <span id="fileTypeError" class="text-danger"></span>
<input 
    type="file" 
    id="financials"
    class="form-control spaced-input <?php $__errorArgs = ['financials.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
    name="financials[]" 
    accept=".pdf,.doc,.docx,.xls,.xlsx" 
    required
    value="<?php echo e(old('financials.0')); ?>"
>

<?php $__errorArgs = ['financials.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="text-danger">This Field is Required</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<script>
document.getElementById('financials').addEventListener('change', function(event) {
    const allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
    const fileInput = event.target;
    const file = fileInput.files[0];
    const errorSpan = document.getElementById('fileTypeError');
    if (file) {
        const fileExtension = file.name.split('.').pop().toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            errorSpan.textContent = 'Invalid file type selected!';
            fileInput.value = ''; // Clear the file input
        } else {
            errorSpan.textContent = '';
        }
    } else {
        errorSpan.textContent = '';
    }
});
</script>
                <!-- <input 
                    type="file" 
                    id="financials"
                    class="form-control spaced-input <?php $__errorArgs = ['financials.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                    name="financials[]" 
                    accept=".pdf,.doc,.docx,.xls,.xlsx" 
                    required
                    value="<?php echo e(old('financials.0')); ?>"
                >
                <?php $__errorArgs = ['financials.0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger">This Field is Required</span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> -->
            </div>
            
            <div class="col-md-1">
                <button class="btn btn-info float-end" type="button" onclick="addFinancialsField()">+ </button>
            </div>
        </div>
    </div>
    </div>

    <div class="mb-4">
    <label id="labelinput" for="other_attachment" style="color: red;">Other Attachment<small> (pdf, doc, docx, xls, xlsx, ppt, pptx)</small></label>
    <input 
    type="file" 
    class="form-control spaced-input <?php $__errorArgs = ['other_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
    id="other_attachment" 
    name="other_attachment"
    value="<?php echo e(old('other_attachment')); ?>"
    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" 
    >
    <span id="otherAttachmentError" class="text-danger"></span>
    <?php $__errorArgs = ['other_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This Field is Required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <script>
        document.getElementById('other_attachment').addEventListener('change', function(event) {
            const allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
            const fileInput = event.target;
            const file = fileInput.files[0];
            const errorSpan = document.getElementById('otherAttachmentError');
            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    errorSpan.textContent = 'Invalid file type selected!';
                    fileInput.value = ''; // Clear the file input
                } else {
                    errorSpan.textContent = '';
                }
            } else {
                errorSpan.textContent = '';
            }
        });
    </script>
    <!-- <input 
        type="file" 
        class="form-control spaced-input <?php $__errorArgs = ['other_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
        id="other_attachment" 
        name="other_attachment"
        value = "<?php echo e(old('other_attachment')); ?>"
        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" 
    >
    <?php $__errorArgs = ['other_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger">This Field is Required</span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> -->
    </div>
    <!-- <hr> -->

    <!-- Referral Source Section -->
    <div class="row mb-2 align-items-end bordered-row">
    <div class="heading-with-hr">
        <h3 class="mb-1" style="font-size: 22px; font-weight: 600;">How did you hear about Investor Dekho? <span style="color:red;">*</span></h3>
        <!-- <hr> -->
    </div>
    <div class="form-floating mb-4">
        <label id="labelinput" for="referral_source" class="required"></label>
        <select 
            class="form-control spaced-input <?php $__errorArgs = ['referral_source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="referral_source" 
            name="referral_source" 
            required
        >
            <option value="" disabled <?php echo e(old('referral_source') ? '' : 'selected'); ?>>Select Source</option>
            <option value="Friend/Family" <?php echo e(old('referral_source') == 'Friend/Family' ? 'selected' : ''); ?>>Friend/Family</option>
            <option value="Social Media (Facebook, Instagram, Twitter/X, etc.)" <?php echo e(old('referral_source') == 'Social Media (Facebook, Instagram, Twitter/X, etc.)' ? 'selected' : ''); ?>>Social Media (Facebook, Instagram, Twitter/X, etc.)</option>
            <option value="Online Search (Google, Bing, etc.)" <?php echo e(old('referral_source') == 'Online Search (Google, Bing, etc.)' ? 'selected' : ''); ?>>Online Search (Google, Bing, etc.)</option>
            <option value="Advertisement (TV, Radio, Print)" <?php echo e(old('referral_source') == 'Advertisement (TV, Radio, Print)' ? 'selected' : ''); ?>>Advertisement (TV, Radio, Print)</option>
            <option value="Email Newsletter" <?php echo e(old('referral_source') == 'Email Newsletter' ? 'selected' : ''); ?>>Email Newsletter</option>
            <option value="Event/Seminar" <?php echo e(old('referral_source') == 'Event/Seminar' ? 'selected' : ''); ?>>Event/Seminar</option>
            <option value="Professional Referral (Doctor, Lawyer, etc.)" <?php echo e(old('referral_source') == 'Professional Referral (Doctor, Lawyer, etc.)' ? 'selected' : ''); ?>>Professional Referral (Doctor, Lawyer, etc.)</option>
            <option value="Blog/Website" <?php echo e(old('referral_source') == 'Blog/Website' ? 'selected' : ''); ?>>Blog/Website</option>
            <option value="Direct Mail" <?php echo e(old('referral_source') == 'Direct Mail' ? 'selected' : ''); ?>>Direct Mail</option>
            <option value="Company Website" <?php echo e(old('referral_source') == 'Company Website' ? 'selected' : ''); ?>>Company Website</option>
        </select>
        <?php $__errorArgs = ['referral_source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger">This Field is Required</span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    </div>


    <div class="row g-3 mb-4 bordered-row">
                        <div class="heading-with-hr">
                            <h3 class="required" style="font-size: 22px; font-weight: 600;" >How can we guide you in fund raise?</h3>
                            <!-- <hr> -->
                        </div>
                        <div class="form-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="capital_raise" name="guidance_needed[]" value="Capital Raise" 
                                <?php echo e(in_array('Capital Raise', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="capital_raise">Capital Raise</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="valuation_modelling" name="guidance_needed[]" value="Valuation and Financial Modelling"
                                    <?php echo e(in_array('Valuation and Financial Modelling', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="valuation_modelling">Valuation and Financial Modelling</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ma_advisory" name="guidance_needed[]" value="M&A Advisory"
                                    <?php echo e(in_array('M&A Advisory', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="ma_advisory">M&A Advisory</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pitch_deck" name="guidance_needed[]" value="Pitch deck Preparation"
                                    <?php echo e(in_array('Pitch deck Preparation', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="pitch_deck">Pitch deck Preparation</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="investor_pitching" name="guidance_needed[]" value="Investor Pitching"
                                    <?php echo e(in_array('Investor Pitching', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="investor_pitching">Investor Pitching</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="na" name="guidance_needed[]" value="NA"
                                    <?php echo e(in_array('NA', old('guidance_needed', [])) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="na">NA</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="others_checkbox" name="others_checkbox" <?php echo e(old('others_checkbox') ? 'checked' : ''); ?> value="Others" onclick="toggleOtherField()">
                                <label class="form-check-label" for="others_checkbox">Others</label>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="other_field" style="display: none;">
                            <label id="labelinput" for="other_guidance">Please specify (Others)</label>
                            <input type="text" name="guidance_needed[]" id="other_guidance_input" class="form-control" value="<?php echo e(old('other_guidance')); ?>" placeholder="Please specify your other guidance">

                        </div>
                    </div>

    <!-- CAPTCHA Section -->
   
    <!-- Terms and Conditions Section -->
    <!-- <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="terms" name="terms" value="1" <?php echo e(old('terms') ? 'checked' : ''); ?> required>
        <label class="form-check-label" for="terms">
            I agree to the 
            <a href="<?php echo e(route('terms')); ?>" target="_blank" rel="noopener">Terms and Conditions</a>
        </label>
    </div> -->

     <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="terms" name="terms" value="1" <?php echo e(old('terms') ? 'checked' : ''); ?> required>
                        <label class="form-check-label" for="terms">
                            I agree to the 
                            <a href="<?php echo e(route('terms')); ?>" target="_blank" rel="noopener">Terms and Conditions</a>
                        </label>
                        <?php $__errorArgs = ['terms'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger">You must agree to the Terms and Conditions</span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
    

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary py-3 px-5 w-100">Submit</button>
</form>

</div>

<!-- Script for Auto-Fill Functionality -->
 <script>

    function fillConcernedPersonDetails() {
        const nameField = document.getElementById('concerned_person_name');
        const designationField = document.getElementById('concerned_person_designation');
        const phoneField = document.getElementById('concerned_person_phone');
        const emailField = document.getElementById('concerned_person_email');

        if (document.getElementById('concerned_person_is_me').checked) {
            // Fill in with the logged-in user details if necessary (use appropriate server-side user details here)
            nameField.value = "<?php echo e(Auth::user()->name); ?>";
            emailField.value = "<?php echo e(Auth::user()->email); ?>";
            phoneField.value = "<?php echo e(Auth::user()->phone); ?>";
            // designationField.value = "<?php echo e(Auth::user()->designation ?? ''); ?>";  // Assuming user model has these field

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

     document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('concerned_person_is_me').checked) {
            fillConcernedPersonDetails();
        }
    });

// Prevent form submission without filling required fields
document.getElementById('investeeForm').addEventListener('submit', function(event) {
    const requiredFields = document.querySelectorAll('#investeeForm [required]:not([disabled]):not([type="hidden"])');
    let isValid = true;

    requiredFields.forEach(field => {
        // Remove previous invalid state
        field.classList.remove('is-invalid');

        if (field.type === 'checkbox') {
            // Only validate checkboxes that are not part of a group (like terms)
            if (field.name === 'terms' && !field.checked) {
                isValid = false;
                field.classList.add('is-invalid');
                field.scrollIntoView({behavior:'smooth', block:'center'});
            }
        } else if (field.type === 'file') {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
                field.scrollIntoView({behavior:'smooth', block:'center'});
            }
        } else {
            const value = field.value.trim();
            if (!value) {
                isValid = false;
                field.classList.add('is-invalid');
                field.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Custom validation for dynamically added public_links[] and link_descriptions[]
    // Custom validation for dynamically added public_links[] and link_descriptions[]
    const publicLinks = document.querySelectorAll('input[name="public_links[]"]');
    const linkDescriptions = document.querySelectorAll('select[name="link_descriptions[]"]');
    for (let i = 0; i < publicLinks.length; i++) {
        publicLinks[i].classList.remove('is-invalid');
        linkDescriptions[i].classList.remove('is-invalid');
        const linkFilled = publicLinks[i].value.trim() !== '';
        const descSelected = linkDescriptions[i].value && linkDescriptions[i].value.trim() !== '';
       
        
        if (publicLinks.length === 1) {
            // Only one row
            if ((linkFilled && !descSelected) || (!linkFilled && descSelected)) {
                if (!linkFilled) publicLinks[i].classList.add('is-invalid');
                if (!descSelected) linkDescriptions[i].classList.add('is-invalid');
                isValid = false;
                publicLinks[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        // if both empty: allowed (do nothing)
        }
        else {
            // More than one row
            if (i === 0) {
                // First row is always required
                if (!linkFilled) {
                    publicLinks[i].classList.add('is-invalid');
                    isValid = false;
                    publicLinks[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                if (!descSelected) {
                    linkDescriptions[i].classList.add('is-invalid');
                    isValid = false;
                    linkDescriptions[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // All other rows must be either fully filled or fully empty
                if ((linkFilled && !descSelected) || (!linkFilled && descSelected)) {
                    if (!linkFilled) publicLinks[i].classList.add('is-invalid');
                    if (!descSelected) linkDescriptions[i].classList.add('is-invalid');
                    isValid = false;
                    publicLinks[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else if (!linkFilled && !descSelected) {
                    // ❌ error on both if completely empty
                    publicLinks[i].classList.add('is-invalid');
                    linkDescriptions[i].classList.add('is-invalid');
                    isValid = false;
                    publicLinks[i].scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }
    }

    if (!isValid) {
        event.preventDefault();
        alert('Please fill all required fields before submitting the form.');
    }
});


 </script>
<script>
   document.getElementById('concerned_person_is_me').addEventListener('change', function() {
    const nameField = document.getElementById('concerned_person_name');
    const emailField = document.getElementById('concerned_person_email');
    const phoneField = document.getElementById('concerned_person_phone');

    if (this.checked) {
        // Auto-fill the fields with the registered user's details
        nameField.value = "<?php echo e(auth()->user()->name); ?>";
        emailField.value = "<?php echo e(auth()->user()->email); ?>";
        phoneField.value = "<?php echo e(auth()->user()->phone); ?>";

        // Disable the fields to prevent editing
        nameField.setAttribute('readonly', true);
        emailField.setAttribute('readonly', true);
        phoneField.setAttribute('readonly', true);
    } else {
        // Clear the fields and allow them to be edited again
        nameField.value = '';
        emailField.value = '';
        phoneField.value = '';

        // Enable the fields for editing
        nameField.removeAttribute('readonly');
        emailField.removeAttribute('readonly');
        phoneField.removeAttribute('readonly');
    }
});

function toggleOtherField() {
    const otherField = document.getElementById('other_field');
    const otherGuidanceContainer = document.getElementById('other_guidance'); // This will hold the input box

    if (document.getElementById('others_checkbox').checked) {
        // Show the input field
        otherField.style.display = 'block';

        // Clear any previous content
        otherGuidanceContainer.innerHTML = '';

        // Create the input field dynamically
        const inputDiv = document.createElement('div');
        inputDiv.classList.add('form-group'); // Add Bootstrap styling

        const input = document.createElement('input');
        input.type = 'text';
        input.classList.add('form-control'); // Add Bootstrap form control class
        input.name = 'other_guidance';
        input.id = 'other_guidance_input';
        input.placeholder = 'Please specify your other guidance';

        // Append the input field to the div
        inputDiv.appendChild(input);

        // Append the div to the container
        otherGuidanceContainer.appendChild(inputDiv);
    } else {
        // Hide the input field if "Others" is unchecked
        otherField.style.display = 'none';
    }
}

// Check if "Others" checkbox was previously checked and input was filled after form reload
window.onload = function() {
    const othersCheckbox = document.getElementById('others_checkbox');
    const otherField = document.getElementById('other_field');
    const otherGuidanceContainer = document.getElementById('other_guidance');
    
    if (othersCheckbox.checked) {
        otherField.style.display = 'block';

        // Check if there's an existing value in the "other_guidance" input field
        if (document.getElementById('other_guidance_input')) {
            const input = document.getElementById('other_guidance_input');
            input.value = "<?php echo e(old('other_guidance')); ?>"; // Retain value from old input
          
        }
    }
};


// Function to add a new link field
function addPublicLinkField() {
    // Get the public links container
    const container = document.getElementById('public-links-container');

    // Create a new div for the input group with row structure to match Bootstrap columns
    const newRow = document.createElement('div');
    newRow.classList.add('row', 'g-0', 'mb-3');

    // Create the URL input field with the same col-sm-5 class
    const urlDiv = document.createElement('div');
    urlDiv.classList.add('col-sm-5');
    const urlInput = document.createElement('input');
    urlInput.type = 'url';
    urlInput.name = 'public_links[]';
    urlInput.classList.add('form-control', 'spaced-input');
    urlInput.placeholder = 'URL';

    // Create the select dropdown with the same col-sm-5 class
    const selectDiv = document.createElement('div');
    selectDiv.classList.add('col-sm-5');
    const select = document.createElement('select');
    select.name = 'link_descriptions[]';
    select.classList.add('form-control', 'spaced-input');
    select.required = true;

    // Add options to the select field
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    defaultOption.textContent = 'Select Account';

    const facebookOption = document.createElement('option');
    facebookOption.value = 'Facebook';
    facebookOption.textContent = 'Facebook';

    const twitterOption = document.createElement('option');
    twitterOption.value = 'Twitter/X';
    twitterOption.textContent = 'Twitter/X';

    const othersOption = document.createElement('option');
    othersOption.value = 'Others';
    othersOption.textContent = 'Others';

    select.appendChild(defaultOption);
    select.appendChild(facebookOption);
    select.appendChild(twitterOption);
    select.appendChild(othersOption);

    // Create the remove button with the col-sm-2 class to align with Add More Links
    const buttonDiv = document.createElement('div');
    buttonDiv.classList.add('col-sm-2', 'text-end'); // Align right for consistency with Add More Links
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger');
    removeButton.textContent = '×';
    removeButton.onclick = function() {
        removeLinkField(removeButton);
    };

    // Append all elements to the respective divs
    urlDiv.appendChild(urlInput);
    selectDiv.appendChild(select);
    buttonDiv.appendChild(removeButton);

    // Append all divs to the newRow
    newRow.appendChild(urlDiv);
    newRow.appendChild(selectDiv);
    newRow.appendChild(buttonDiv);

    // Append the new row to the container
    container.appendChild(newRow);
}

// Function to remove a link field
function removeLinkField(button) {
    const row = button.closest('.row');
    row.remove();  // Remove the parent row div
}



    function addFounderField() {
   
        var container = document.getElementById('founder-details-container');

    
        var newRow = document.createElement('div');
        newRow.className = 'row g-1';

    
        newRow.innerHTML = `
        
          
            <div class="col-md-2">
                <label id="labelinput" for="founder_name" class="required">Name</label>
                <input type="text" class="form-control" name="founder_name[]" required>
            </div>
            <div class="col-md-2">
                <label id="labelinput" for="founder_position" class="required">Position</label>
                <select class="form-control" name="founder_position[]" required>
                    <option value="" disabled selected>Select Position</option>
                    <option value="Chief Administrative Officer">Chief Administrative Officer</option>
                    <option value="Chief Analytics Officer">Chief Analytics Officer</option>
                    <option value="Chief Brand Officer">Chief Brand Officer</option>
                    <option value="Chief Business Development Officer">Chief Business Development Officer</option>
                    <option value="Chief Business Officer">Chief Business Officer</option>
                    <option value="Chief Commercial Officer">Chief Commercial Officer</option>
                    <option value="Chief Communications Officer">Chief Communications Officer</option>
                    <option value="Chief Compliance Officer">Chief Compliance Officer</option>
                    <option value="Chief Content Officer">Chief Content Officer</option>
                    <option value="Chief Creative Officer">Chief Creative Officer</option>
                    <option value="Chief Customer Officer">Chief Customer Officer</option>
                    <option value="Chief Data Officer">Chief Data Officer</option>
                    <option value="Chief Design Officer">Chief Design Officer</option>
                    <option value="Chief Digital Officer">Chief Digital Officer</option>
                    <option value="Chief Diversity Officer">Chief Diversity Officer</option>
                    <option value="Chief Executive Officer">Chief Executive Officer</option>
                    <option value="Chief Experience Officer">Chief Experience Officer</option>
                    <option value="Chief Financial Officer">Chief Financial Officer</option>
                    <option value="Chief Gaming Officer">Chief Gaming Officer</option>
                    <option value="Chief Genealogical Officer">Chief Genealogical Officer</option>
                    <option value="Chief Human Resources Officer">Chief Human Resources Officer</option>
                    <option value="Chief Information Officer">Chief Information Officer</option>
                    <option value="Chief Information Officer (Higher Education)">Chief Information Officer (Higher Education)</option>
                    <option value="Chief Information Security Officer">Chief Information Security Officer</option>
                    <option value="Chief Innovation Officer">Chief Innovation Officer</option>
                    <option value="Chief Investment Officer">Chief Investment Officer</option>
                    <option value="Chief Knowledge Officer">Chief Knowledge Officer</option>
                    <option value="Chief Learning Officer">Chief Learning Officer</option>
                    <option value="Chief Marketing Officer">Chief Marketing Officer</option>
                    <option value="Chief Operating Officer">Chief Operating Officer</option>
                    <option value="Chief Privacy Officer">Chief Privacy Officer</option>
                    <option value="Chief Process Officer">Chief Process Officer</option>
                    <option value="Chief Product Officer">Chief Product Officer</option>
                    <option value="Chief Reputation Officer">Chief Reputation Officer</option>
                    <option value="Chief Research Officer">Chief Research Officer</option>
                    <option value="Chief Restructuring Officer">Chief Restructuring Officer</option>
                    <option value="Chief Risk Officer">Chief Risk Officer</option>
                    <option value="Chief Science Officer">Chief Science Officer</option>
                    <option value="Chief Scientific Officer">Chief Scientific Officer</option>
                    <option value="Chief Security Officer">Chief Security Officer</option>
                    <option value="Chief Services Officer">Chief Services Officer</option>
                    <option value="Chief Strategy Officer">Chief Strategy Officer</option>
                    <option value="Chief Sustainability Officer">Chief Sustainability Officer</option>
                    <option value="Chief Technology Officer">Chief Technology Officer</option>
                    <option value="Chief Visibility Officer">Chief Visibility Officer</option>
                    <option value="Chief Visionary Officer">Chief Visionary Officer</option>
                    <option value="Chief Web Officer">Chief Web Officer</option>
                    <option value="General Manager">General Manager</option>
                    <option value="Manager">Manager</option>
                    <option value="Others">Others</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Vice President">Vice President</option>
                </select>
            </div>
            <div class="col-md-2">
                <label id="labelinput" for="founder_education" class="required">Highest Qualification</label>
                <input type="text" class="form-control" name="founder_education[]" required
                    pattern="^[A-Za-z\s.\-&']+$"
                    title="Only letters, spaces, dots, hyphens, ampersands, and apostrophes are allowed."
                    oninput="filterQualificationInput(this)"
                    >
            </div>
           
            <div class="col-md-3">
                <label id="labelinput" for="founder_experience" class="required">Work Experience (In Years)</label>
                <input type="number" class="form-control " name="founder_experience[]" 
                    step="0.1"       
                    min="0.1"
                    max="100"
                    oninput="if (this.value < 0.1) this.value = ''" 
                    required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger float-end mt-4" type="button" onclick="removeFounderField(this)">×</button>
            </div>
        `;

        
        container.appendChild(newRow);
}


// Function to remove founder fields
function removeFounderField(button) {
    // Find the row and remove it
    button.closest('.row').remove();
}

// Ensure total fund is calculated only from currently rendered fund fields
document.addEventListener('DOMContentLoaded', function () {
    function calculateTotalFund() {
        let total = 0;
        // Only sum up currently rendered and visible fund_requirement fields
        const fundInputs = document.querySelectorAll('#funds-container input[name="fund_requirement[]"]');
        const unitSelects = document.querySelectorAll('#funds-container select[name="fund_unit[]"]');
        fundInputs.forEach((input, idx) => {
            let value = parseFloat(input.value);
            let unit = unitSelects[idx] ? unitSelects[idx].value : 'crores';
            if (!isNaN(value)) {
                if (unit === "lakhs") {
                    value = value / 100;
                }
                total += value;
            }
        });
        document.getElementById('total_fund_raised').value = (total > 0 ? total.toFixed(2) : '') + (total > 0 ? ' Cr' : '');
    }

    // Attach event listeners to all current and future fund fields
    function attachFundListeners() {
        document.querySelectorAll('#funds-container input[name="fund_requirement[]"]').forEach(input => {
            input.removeEventListener('input', calculateTotalFund);
            input.addEventListener('input', calculateTotalFund);
        });
        document.querySelectorAll('#funds-container select[name="fund_unit[]"]').forEach(select => {
            select.removeEventListener('change', calculateTotalFund);
            select.addEventListener('change', calculateTotalFund);
        });
    }

    // Initial attach
    attachFundListeners();
    calculateTotalFund();

    // Add new fund fields dynamically
    window.addFundField = function () {
        const container = document.getElementById('funds-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3 align-items-end';

        newRow.innerHTML = `
            <div class="col-md-3">
                <label id="labelinput" for="fund_usage" class="required">Usage of Fund</label>
                <select class="form-control spaced-input" name="fund_usage[]" required>
                    <option value="" disabled selected>Select Usage</option>
                    <option value="Capex">Capex</option>
                    <option value="Opex">Opex</option>
                    <option value="Acquisition">Acquisition</option>
                    <option value="Debt Requirement">Debt Requirement</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="fund_requirement" class="required">Fund Requirement</label>
                <div class="input-group">
                    <input class="form-control spaced-input" type="number" name="fund_requirement[]"  min="1"
                    step="0.01"
                    oninput="if (this.value < 1) this.value = ''"
                    required>
                    <select class="form-select spaced-input" name="fund_unit[]" required>
                        <option value="crores">Cr</option>
                        <option value="lakhs">Lakh</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 mt-3">
                <button class="btn btn-danger float-end" type="button" onclick="removeFundField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);
        attachFundListeners();
        calculateTotalFund();
    };

    // Remove fund field and recalculate
    window.removeFundField = function (button) {
        const row = button.closest('.row');
        row.remove();
        calculateTotalFund();
    };

    // Recalculate on page load (for browser autofill or back navigation)
    setTimeout(() => {
        calculateTotalFund();
    }, 100);

    // Attach listeners again after DOM changes (for back navigation)
    window.addEventListener('pageshow', function() {
        attachFundListeners();
        calculateTotalFund();
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Function to add a new previous round field set
    window.addPreviousRoundField = function () {
        const container = document.getElementById('previous-rounds-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3 align-items-end bordered-row';

        newRow.innerHTML = `
            <div class="col-md-2">
                <label id="labelinput" for="previous_rounds" class="required">Previous Round</label>
                <select class="form-control spaced-input" name="previous_rounds[]" required>
                    <option value="" disabled selected>Select Round</option>
                    <option value="Pre seed round">Pre seed round</option>
                    <option value="Seed Round">Seed Round</option>
                    <option value="Series A round">Series A round</option>
                    <option value="Series B round">Series B round</option>
                    <option value="Series C round">Series C round</option>
                    <option value="Series D round">Series D round</option>
                    <option value="Series E and beyond">Series E and beyond</option>
                </select>
            </div>
            <div class="col-md-3">
                <label id="labelinput" for="investors" class="required">Investors</label>
                <input type="text" class="form-control spaced-input" name="investors[]" required 
                    pattern="^[A-Za-z\s.,&'-]+$"
                    title="Only letters, spaces, commas, periods, ampersands, and hyphens are allowed."
                    oninput="filterInvestorInput(this)"
                   >
            </div>
            <div class="col-md-3">
                <label id="labelinput" for="amount_raised" class="required">Amount Raised (in cr)</label>
                <input type="number" class="form-control spaced-input" name="amount_raised[]" min="0.01" step="0.01" required>

            </div>
            <div class="col-md-3">
                <label id="labelinput" for="valuation" class="required">Valuation (in cr)</label>
                <input type="number" class="form-control spaced-input" name="valuation[]" min="0.01"
                    step="0.01"
                    oninput="if (this.value <= 0) this.value = ''" required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger float-end" type="button" onclick="removePreviousRoundField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);
    };

    // Function to remove a previous round field set
    window.removePreviousRoundField = function (button) {
        const row = button.closest('.row');
        row.remove();
    };
});


document.addEventListener('DOMContentLoaded', function () {
    // Function to add a new financials field set
    window.addFinancialsField = function () {
        const container = document.getElementById('financials-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-4 align-items-end';

        newRow.innerHTML = `
            <div class="col-md-3">
                <label id="labelinput" for="financial_year" class="required">Fiscal Year</label>
                <select class="form-control spaced-input" name="financial_year[]" required>
                    <option value="" disabled selected>Select Year</option>
                    <option value="2020-2021">2020-2021</option>
                    <option value="2021-2022">2021-2022</option>
                    <option value="2022-2023">2022-2023</option>
                    <option value="2023-2024">2023-2024</option>
                    <option value="2024-2025">2024-2025</option>
                </select>
            </div>
            <div class="col-md-8">
                <label id="labelinput" for="financials" class="required">Choose file</label>
                <input type="file" class="form-control spaced-input" name="financials[]" accept=".pdf,.doc,.docx" required>
            </div>
            <div class="col-md-1">
                <button class="btn btn-danger float-end" type="button" onclick="removeFinancialsField(this)">×</button>
            </div>
        `;

        container.appendChild(newRow);
    };

    // Function to remove a financials field set
    window.removeFinancialsField = function (button) {
        const row = button.closest('.row');
        row.remove();
    };
});



document.getElementById('pitch_deck').addEventListener('change', function() {
        var file = this.files[0];
        var allowedExtensions = /(\.pdf|\.doc|\.docx|\.ppt|\.pptx)$/i;
        
        if (!allowedExtensions.exec(file.name)) {
            document.getElementById('file-error').innerText = 'Invalid file type. Only PDF, DOC, or DOCX files are allowed.';
            this.value = ''; // Clear the file input
        } else {
            document.getElementById('file-error').innerText = ''; // Clear the error message if the file is valid
        }
    });


</script>




<script>
function validateYear() {
    const input = document.getElementById("incorporated_in");
    const errorDiv = document.getElementById("incorporated_in_error");
    const year = parseInt(input.value);
    const currentYear = new Date().getFullYear();

    if (!input.value) {
        errorDiv.textContent = "This field is required.";
        input.focus();
        return false;
    }

    if (isNaN(year) || year < 1800 || year > currentYear) {
        errorDiv.textContent = `Please enter a valid year between 1800 and ${currentYear}.`;
        input.focus();
        return false;
    }

    errorDiv.textContent = "";
    return true;
}
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const submitbutton = document.querySelector('button[type="submit"]');
    const yearInput = document.getElementById("incorporated_in");

    if (!form || !submitbutton || !yearInput) return;

    form.addEventListener("submit", function (e) {
        if (!validateYear()) {
            e.preventDefault();
        }
    });

    // Set initial state
    submitbutton.disabled = !validateYear();

    // Enable/disable submit button on year input change
    yearInput.addEventListener("input", function () {
        submitbutton.disabled = !validateYear();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('concerned_person_email');
    const form = document.querySelector('form');
    const emailError = document.getElementById('concerned_person_email_error');

    // Real-time validation
    emailInput.addEventListener('input', function () {
        const emailValue = emailInput.value.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (!emailPattern.test(emailValue)) {
            emailError.textContent = "Please enter a valid email address.e.g.,demo@gmail.com";
        } else {
            emailError.textContent = "";
        }
    });

    // Form submit validation
    form.addEventListener('submit', function (event) {
        const emailValue = emailInput.value.trim();
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(emailValue)) {
            event.preventDefault();
            emailError.textContent = "Please enter a valid email address.e.g.,demo@gmail.com";
            emailInput.focus();
        } else {
            emailError.textContent = "";
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let websiteInput = document.getElementById('company_website');
    let linkedinInput = document.getElementById('linkedin_link');
    let websiteError = document.getElementById('company_website_error');
    let linkedinError = document.getElementById('linkedin_link_error');
    let form = document.querySelector('form');

    // Real-time validation for website input
    websiteInput.addEventListener('input', function () {
        // let urlPattern = /^(https?:\/\/)?([\w-]+(\.[\w-]+)+)(\/[\w- .\/?%&=]*)?$/;
            const urlPattern = /^(https?:\/\/)?([\w-]+\.)+[\w-]{2,}(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/;

        if (!urlPattern.test(websiteInput.value)) {
            websiteError.textContent = "Please enter a valid URL. e.g., https://www.example.com";
        } else {
            websiteError.textContent = "";
        }
    });

    // on change validation for website input
    websiteInput.addEventListener('change', function () {
         const urlPattern = /^(https?:\/\/)?([\w-]+\.)+[\w-]{2,}(\/[\w\-._~:/?#[\]@!$&'()*+,;=]*)?$/;

        if (!urlPattern.test(websiteInput.value)) {
            websiteError.textContent = "Please enter a valid URL. e.g., https://www.example.com";
            websiteInput.focus();
        } else {
            websiteError.textContent = "";
        }
    });

    // Real-time validation for LinkedIn input
    linkedinInput.addEventListener('input', function () {
        let linkedinPattern = /^https?:\/\/(www\.)?linkedin\.com\/(in|company|school|groups|showcase|events|posts|feed)\/[a-zA-Z0-9\-_/]+\/?$/;
        if (!linkedinPattern.test(linkedinInput.value)) {
            linkedinError.textContent = "Please enter a valid LinkedIn URL. e.g., https://www.linkedin.com/in/username/";
        } else {
            linkedinError.textContent = "";
        }
    });

    // on change validation for LinkedIn input
    linkedinInput.addEventListener('change', function () {
        let linkedinPattern = /^https?:\/\/(www\.)?linkedin\.com\/(in|company|school|groups|showcase|events|posts|feed)\/[a-zA-Z0-9\-_/]+\/?$/;
        if (!linkedinPattern.test(linkedinInput.value)) {
            linkedinError.textContent = "Please enter a valid LinkedIn URL. e.g., https://linkedin.com/company/yourcompany";
            linkedinInput.focus();
        } else {
            linkedinError.textContent = "";
        }
    });

    // Form submit validation
    form.addEventListener('submit', function (event) {
        let isValid = true;

        // Validate website input
        if (!websiteInput.value || !/^(https?:\/\/)?([\w-]+(\.[\w-]+)+)(\/[\w- .\/?%&=]*)?$/.test(websiteInput.value)) {
            websiteError.textContent = "Please enter a valid URL. e.g., https://www.example.com";
            isValid = false;
        }

        // Validate LinkedIn input
        if (!linkedinInput.value || !/^https?:\/\/(www\.)?linkedin\.com\/(in|company|school|groups|showcase|events|posts|feed)\/[a-zA-Z0-9\-_/]+\/?$/.test(linkedinInput.value)) {
            linkedinError.textContent = "Please enter a valid LinkedIn URL. e.g., https://linkedin.com/company/yourcompany";
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
            if (!websiteInput.value) websiteInput.focus();
            else linkedinInput.focus();
        }
    });
});
</script>

<script>
            function filterQualificationInput(input) {
                // Allow only letters, spaces, dots, hyphens, ampersands, and apostrophes
                input.value = input.value.replace(/[^A-Za-z\s.\-&']/g, '');
            }
</script>

<script>
            function filterInvestorInput(input) {
                // Allow only letters, spaces, commas, periods, ampersands, and hyphens
                input.value = input.value.replace(/[^A-Za-z\s.,&'-]/g, '');
            }
</script>

<script>
    function showError(input, message) {
        input.classList.add('is-invalid');
        let errorDiv = input.parentElement.querySelector('.invalid-feedback');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback d-block';
            input.parentElement.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    function clearError(input) {
        input.classList.remove('is-invalid');
        const errorDiv = input.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) errorDiv.remove();
    }

    function validateAllLinks(showAlert = false) {
        let isValid = true;
        let scrolled = false;

        const publicLinks = document.querySelectorAll('input[name="public_links[]"]');
        const descriptions = document.querySelectorAll('select[name="link_descriptions[]"]');

        publicLinks.forEach((input, i) => {
            const link = input.value.trim();
            const desc = descriptions[i].value.trim();

            clearError(input);
            clearError(descriptions[i]);

            // One filled, other not
            if ((link && !desc) || (!link && desc)) {
                if (!link) showError(input, 'URL is required');
                if (!desc) showError(descriptions[i], 'Account type is required');
                isValid = false;
            }

            // First row required if multiple
            if (publicLinks.length > 1 && i === 0 && (!link || !desc)) {
                if (!link) showError(input, 'URL is required');
                if (!desc) showError(descriptions[i], 'Account type is required');
                isValid = false;
            }

            // Pattern check
            if (link && desc === 'Facebook' && !/^https?:\/\/(www\.)?facebook\.com\/[a-zA-Z0-9._-]+$/.test(link)) {
                showError(input, 'Valid Facebook URL required. e.g., https://www.facebook.com/username');
                isValid = false;
            }

            if (link && desc === 'Twitter/X' && !/^https?:\/\/(www\.)?(twitter\.com|x\.com)\/[a-zA-Z0-9_]+\/?$/.test(link)) {
                showError(input, 'Valid Twitter/X URL required. e.g., https://x.com/yourhandle');
                isValid = false;
            }

            // Scroll to first error only
            if (!isValid && !scrolled && input.classList.contains('is-invalid')) {
                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                scrolled = true;
            }
        });

        if (!isValid && showAlert) {
            alert('Please fix the highlighted errors before submitting.');
        }

        return isValid;
    }

    // Form submission
    document.querySelector('form').addEventListener('submit', function (e) {
        if (!validateAllLinks(true)) {
            e.preventDefault();
        }
    });

    // Input validation on typing
    document.addEventListener('input', function (e) {
        if (e.target.name === 'public_links[]') {
            validateAllLinks();
        }
    });

    // Validation on dropdown change
    document.addEventListener('change', function (e) {
        if (e.target.name === 'link_descriptions[]') {
            validateAllLinks();
        }
    });
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const formid = document.getElementById('investeeForm');
   formid.addEventListener('submit', function (e) {
        const isFormValid = validateAllLinks(true);
        console.log('Validation result:', isFormValid); // Debug: see if validation returned false
        if (!isFormValid) {
            e.preventDefault(); // 🔴 This will definitely stop form submission
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const phonePattern = /^\+?[0-9]{7,20}$/;

    // Define all phone inputs you want to validate
    const phoneInputs = [
        {
            input: document.getElementById('phone_number'),
            formIds: ['form', 'investmentBankerForm']
        },
        {
            input: document.getElementById('concerned_person_phone'),
            formIds: ['investeeForm']
        }
    ];

    phoneInputs.forEach(({ input, formIds }) => {
        if (!input) return;

        // Create and insert error container
        const errorContainer = document.createElement('div');
        errorContainer.className = 'text-danger small mt-1';
        input.parentNode.appendChild(errorContainer);

        // Real-time validation
        input.addEventListener('input', function () {
            input.value = input.value.replace(/(?!^\+)[^0-9]/g, '');
            const value = input.value.trim();

            if (!phonePattern.test(value)) {
                errorContainer.textContent = "Enter a valid phone number (7 to 20 digits, optional +).";
            } else {
                errorContainer.textContent = "";
            }
        });

        // Form submit validation
        formIds.forEach(id => {
            const form = document.getElementById(id);
            if (form) {
                form.addEventListener('submit', function (event) {
                    const value = input.value.trim();
                    if (!phonePattern.test(value)) {
                        event.preventDefault();
                        errorContainer.textContent = "Enter a valid phone number (7 to 20 digits, optional +).";
                        input.focus();
                    } else {
                        errorContainer.textContent = "";
                    }
                });
            }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/forms/investee_form.blade.php ENDPATH**/ ?>