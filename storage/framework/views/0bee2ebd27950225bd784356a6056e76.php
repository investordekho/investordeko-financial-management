


<?php $__env->startSection('content'); ?>

<style>
/* Container Styling */
.container {
    max-width: 1200px;
    margin: auto;
}

/* Sidebar Styling */
.sidebar {
    height: 100vh;
    position: sticky;
    top: 80px;
    background: linear-gradient(to bottom, #007bff, #0056b3);
    padding: 20px;
    overflow-y: auto;
    border-radius: 8px;
}

.list-group-item {
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    background: transparent;
    color: white;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.list-group-item:hover, .list-group-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
}

/* Main Content Styling */
.main-content {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

/* Section Cards */
.section-card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.section-card:hover {
    transform: translateY(-3px);
}

/* Headings Styling */
h2, h4 {
    border-bottom: 3px solid #007bff;
    padding-bottom: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

/* Form Enhancements */
.form-label {
    font-weight: bold;
    color: #555;
}

.form-control {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 12px 14px;
    font-size: 14px;
    margin-bottom: 15px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.form-control:hover {
    border-color: #007bff;
}

.form-control[readonly] {
    background-color: #e9ecef;
    color: #495057;
}

/* Links inside Public Links Section */
.form-control a {
    color: #007bff;
    font-weight: bold;
    text-decoration: none;
}

.form-control a:hover {
    text-decoration: underline;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .sidebar {
        position: relative;
        height: auto;
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>

<style>
/* Container Styling */
.container {
    max-width: 1200px;
}

/* Sidebar Styling */
.sidebar {
    height: 100vh;
    position: sticky;
    top: 80px;
    background: linear-gradient(to bottom, #007bff, #0056b3);
    padding: 20px;
    overflow-y: auto;
    border-radius: 8px;
}

.list-group-item {
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    background: transparent;
    color: white;
    transition: all 0.3s ease-in-out;
    cursor: pointer;
}

.list-group-item:hover, .list-group-item.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-weight: bold;
    border-radius: 5px;
}

/* Main Content Styling */
.main-content {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

/* Section Cards */
.section-card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.section-card:hover {
    transform: translateY(-3px);
}

/* Headings Styling */
h2, h4 {
    border-bottom: 3px solid #007bff;
    padding-bottom: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    color: #333;
}

/* Form Enhancements */
.form-label {
    font-weight: bold;
    color: #555;
}

.form-control {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 12px 14px;
    font-size: 14px;
    margin-bottom: 15px;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.form-control:hover {
    border-color: #007bff;
}

.form-control[readonly] {
    background-color: #e9ecef;
    color: #495057;
}

/* Links inside Public Links Section */
.form-control a {
    color: #007bff;
    font-weight: bold;
    text-decoration: none;
}

.form-control a:hover {
    text-decoration: underline;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .sidebar {
        position: relative;
        height: auto;
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>

<div class="container">
    <div class="row">
      
        <div class="col-md-3 sidebar">
            <div class="list-group">
                <a href="#investor-details" class="list-group-item active">Investor Details</a>
                <a href="#contact_details" class="list-group-item">Contact Details</a>
                <a href="#public-links" class="list-group-item">Public Links</a>
                <a href="#previous-investment" class="list-group-item">Previous Investments</a>
                <a href="#investment-details" class="list-group-item">Investment Details</a>
                <a href="#referrals" class="list-group-item">Referrals</a>
                <a href="#guidance-needs" class="list-group-item">Guidance Needs</a>
                <a href="#investor-address" class="list-group-item">Investor Address</a>
            </div>
        </div>

       
        <div class="col-md-9 main-content">
        <div class="section-card">
            <h2 id="investor-details">Investor Details</h2>
            
                <div class="mb-3">
                    <label class="form-label">Investor Name</label>
                    <input type="text" class="form-control" value="<?php echo e($investor->investor_name); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" value="<?php echo e($investor->address); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Investor Profile</label>
                    <input type="text" class="form-control" value="<?php echo e($investor->investor_profile); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sectors Preferred</label>
                    <input type="text" class="form-control" value="<?php echo e($investor->sectors_preferred); ?>" readonly>
                </div>    
        </div>
        <div class="section-card">
                <h4 id="contact_details">Contact Details</h4>
                <?php if(isset($investor->contactDetails)): ?>
                   
                    
                        <div class="mb-3">
                        <label class="form-label">Person Name</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->contactDetails->concerned_person_name); ?>" readonly>
                        </div>
                        <?php if(isset($investor->contactDetails->concerned_person_designation)): ?>
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input type="text" class="form-control" value="<?php echo e($investor->contactDetails->concerned_person_designation); ?>" readonly>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($investor->contactDetails->concerned_person_phone)): ?>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="<?php echo e($investor->contactDetails->concerned_person_phone); ?>" readonly>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($investor->contactDetails->email)): ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo e($investor->contactDetails->email); ?>" readonly>
                        </div>
                        <?php endif; ?>
                 
                <?php endif; ?>    
                </div>
                <div class="section-card">
                <h4 id="public-links">Public Links</h4>
                <?php $__currentLoopData = $investor->publicLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <a href="<?php echo e($link->url); ?>" class="form-control"><?php echo e($link->url); ?></a>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" value="<?php echo e($link['link_description']); ?>" readonly>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(isset($investor->previousInvestments)): ?>
                <div class="section-card">
                <h4 id="previous-investment">Previous Investments</h4>
                <?php $__currentLoopData = $investor->previousInvestments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" class="form-control" value="<?php echo e($investment['previous_investment_year']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" value="<?php echo e($investment['previous_investment_company']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sector</label>
                        <input type="text" class="form-control" value="<?php echo e($investment['sector']); ?>" readonly>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php if(isset($investor->investmentDetails)): ?>
                <div class="section-card">
                <h4 id="investment-details">Investment Details</h4>
                
                    <div class="mb-3">
                        <label class="form-label">Invest In</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->investmentDetails->invest_in); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investor Type</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->investmentDetails->investor_type); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investment Size</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->investmentDetails->investment_size); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Investment Tenure</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->investmentDetails->investment_tenure); ?>" readonly>
                    </div>
                
                </div>
                <?php endif; ?>
                <?php if(isset($investor->referrals) && $investor->referrals->isNotEmpty()): ?>
                    <div class="section-card">
                        <h4 id="referrals">Referrals</h4>
                            <?php $__currentLoopData = $investor->referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-3">
                                    <label class="form-label">Referral Source</label>
                                    <input type="text" class="form-control" value="<?php echo e($referral->referral_source); ?>" readonly>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($investor->guidanceNeeds)): ?>
                <div class="section-card">
                <h4 id="guidance-needs">Guidance Needs</h4>
              
                <?php if(isset($investor['guidanceNeeds']) && isset($investor['guidanceNeeds']['guidance_needed'])): ?>
               
                    <div class="mb-3">
                        <label class="form-label">Guidance Needed</label>
                        <textarea class="form-control" readonly><?php echo e($investor->guidanceNeeds->guidance_needed); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Other Guidance</label>
                        <input type="text" class="form-control" value="<?php echo e($investor->guidanceNeeds->other_guidance); ?>" readonly>
                    </div>
               
                <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if(isset($investor->investorAddresses)): ?>
                <div class="section-card">
                <h4 id="investor-address">Investor Address</h4>
                <?php $__currentLoopData = $investor->investorAddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" value="<?php echo e($address->country); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" value="<?php echo e($address->state); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" value="<?php echo e($address->city); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" value="<?php echo e($address->zip_code); ?>" readonly>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".list-group-item").forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let section = document.querySelector(this.getAttribute("href"));
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
    });
</script>

<!-- Smooth Scroll and Active State for Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll("h2, h4"); // Sections to observe
        const links = document.querySelectorAll(".list-group-item");

        // Smooth scroll on click
        links.forEach(link => {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                let section = document.querySelector(this.getAttribute("href"));
                if (section) {
                    section.scrollIntoView({ behavior: "smooth" });
                }
            });
        });

        // Change active link based on scroll
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    links.forEach(link => link.classList.remove("active"));
                    document.querySelector(`.list-group-item[href="#${entry.target.id}"]`)?.classList.add("active");
                }
            });
        }, { threshold: 0.6 }); // 60% of section must be visible

        sections.forEach(section => observer.observe(section));
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.querySelector(".sidebar");
        const navbarHeight = 80; // Adjust according to your actual navbar height
        const maxOffset = 80; // Maximum movement for the sidebar

        window.addEventListener("scroll", function () {
            let scrollY = window.scrollY;

            // Calculate how much the sidebar should move up, capped at maxOffset
            let newTop = Math.max(navbarHeight - Math.min(scrollY, maxOffset), 0) + "px";

            // Apply the new top position smoothly
            sidebar.style.position = "sticky";
            sidebar.style.top = newTop;
            sidebar.style.transition = "top 0.2s ease-in-out"; // Smooth transition
        });
    });
</script>



<?php $__env->stopSection(); ?> 

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/partials/investor_list_detail.blade.php ENDPATH**/ ?>