<!-- Hero Section -->
<section class="hero-banner">
    <div class="container">
        <h1 class="display-4">The complete Database Platform For Discovering <span class="text-success">Startups</span> and <span class="text-primary">Investors</span></h1>
        <p class="lead">Search for Startups, Angel Investors, and VCs</p>

        <!-- Show Search Form and Radio Buttons only if not authenticated -->
        <?php if(auth()->guard()->guest()): ?>
        <!-- Dynamic Search Form -->
        <form class="d-flex justify-content-center search-form" id="searchForm" method="POST" action="#">
            <?php echo csrf_field(); ?>
            <input type="text" id="searchInput" name="search_query" placeholder="Search for Startups/Angel Investor/VC">
            <button type="submit" class="ms-2">Search</button>
        </form>

        <!-- Radio buttons for user type selection -->
        <div class="d-flex justify-content-center mt-3">
            <label class="me-3">
                <input type="radio" name="user-type" class="me-1" value="Investees"> Investees
            </label>
            <label class="me-3">
                <input type="radio" name="user-type" class="me-1" value="Investors"> Investors
            </label>
            <label class="me-3">
                <input type="radio" name="user-type" class="me-1" value="Bankers"> Investment Banker
            </label>
        </div>
        <?php else: ?>
        <!-- Show "Browse Dashboard" Button for Authenticated Users -->
        <div class="d-flex justify-content-center mt-3">
            <a href="
                <?php if(Auth::user()->category_id == 1): ?>
                    <?php echo e(route('investee.dashboard')); ?>

                <?php elseif(Auth::user()->category_id == 2): ?>
                    <?php echo e(route('investor.dashboard')); ?>

                <?php elseif(Auth::user()->category_id == 3): ?>
                    <?php echo e(route('banker.dashboard')); ?>

                <?php elseif(Auth::user()->category_id == 4): ?>
                    <?php echo e(route('other.dashboard')); ?>

                <?php else: ?>
                    <?php echo e(route('home')); ?>

                <?php endif; ?>
            " class="btn btn-primary">
                Browse Dashboard
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');

        // Get user category from the backend using Laravel Blade
        const userCategory = "<?php echo e(auth()->check() ? auth()->user()->category : ''); ?>";

        // Set the placeholder based on the user category
        if (userCategory) {
            switch (userCategory) {
                case 'Investee':
                    searchInput.placeholder = 'Search for Investee';
                    break;
                case 'Investor':
                    searchInput.placeholder = 'Search for Investor';
                    break;
                case 'Banker':
                    searchInput.placeholder = 'Search for Banker';
                    break;
                default:
                    searchInput.placeholder = 'Search for Startups/Angel Investor/VC';
            }
        }

        // Handle form submission
        if (searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const searchQuery = searchInput.value.trim();

                // Ensure the search query is not empty
                if (searchQuery.length === 0) {
                    alert('Please enter a search term.');
                    return;
                }

                // Construct the redirect URL based on the user category
                let redirectUrl = '';

                if (userCategory === 'Investee') {
                    redirectUrl = `/dashboard/investee?search=${encodeURIComponent(searchQuery)}`;
                } else if (userCategory === 'Investor') {
                    redirectUrl = `/dashboard/investor?search=${encodeURIComponent(searchQuery)}`;
                } else if (userCategory === 'Banker') {
                    redirectUrl = `/dashboard/banker?search=${encodeURIComponent(searchQuery)}`;
                } else {
                    // If not authenticated, redirect to the login page
                    redirectUrl = '/login';
                }

                // Redirect to the constructed URL
                window.location.href = redirectUrl;
            });
        }
    });
</script>

<!-- Services Section -->
<section class="services-section">
    <div class="container text-center">
        <?php if(auth()->guard()->guest()): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="service-card">
                    <h5>Browse Investors</h5>
                    <a href="<?php echo e(route('register')); ?>">View Investors</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-card">
                    <h5>Browse Startups</h5>
                    <a href="<?php echo e(route('register')); ?>">View Startups</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>



<div id="sectionimage" class="container-fluid">
    <div class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h2>Our Services</h2>
            <p>Explore the wide range of services we offer to help your business grow.</p>
        </div>
    </div>
   <div class="container my-5">
    <div class="row">
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title  mb-3"><i class="fa-solid fa-hands-holding-circle me-2"></i> Fund Raising</h5>
            <ul class="service-list list-unstyled">
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#equityFundingModal">Equity Funding</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#debtFundingModal">Debt Funding</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#maModal">Mergers & Acquisitions</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#piModal">Pitchdeck Making</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#piiModal">Pitching to Investors</a></li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title mb-3"><i class="fa-solid fa-chart-line me-2"></i> Public Offering</h5>
            <ul class="service-list list-unstyled">
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#ipoPlanningModal">IPO Planning</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#ipoListingModal">IPO Listing</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#bonusSharesModal">Issuance of Bonus Shares</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#rightsIssueModal">Issuance of Rights Issue</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#esopPlanningModal">Employee Stock Options (ESOP) Planning</a></li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title mb-3"><i class="fa-solid fa-file-alt me-2"></i> Intellectual Property and Legal Services</h5>
            <ul class="service-list list-unstyled">
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#patentModal">Patent</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#trademarkModal">Trademark</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#designRegistrationModal">Design Registration</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#dscModal">DSC</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#onlineListingModal">Online Listing</a></li>
            </ul>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title  mb-3"><i class="fa-solid fa-file-alt me-2"></i> Compliance and Regulatory Services</h5>
            <ul class="service-list list-unstyled">
                  <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#incomeTaxModal">Income Tax Return</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#gstCustomsModal">GST, TDS, PF, ESI, PT, Customs</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#mcaRocWorksModal">MCA & ROC Works</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#appointmentResignationModal">Appointment & Resignation of Directors</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#annualReturnModal">Annual Return</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#companyRegistrationModal">Company Registration</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#udyogAadhaarGstModal">Udyog Aadhaar & GST Registration</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#importerExporterCodeModal">Importer-Exporter Code</a></li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title mb-3"><i class="fa-solid fa-file-alt me-2"></i> Financial and Accounting Services</h5>
            <ul class="service-list list-unstyled">
                 <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#loanProposalModal">Loan Proposal</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#cmaDataModal">CMA Data</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#accountingModal">Accounting</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#subsidyModal">Subsidy</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#taxPlanningModal">Tax Planning</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#capitalReStructuringModal">Capital Re-Structuring</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#projectReportModal">Project Report</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#tevStudyModal">TEV Study</a></li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
            <h5 class="service-title mb-3"><i class="fa-solid fa-file-alt me-2"></i> Other Services</h5>
            <ul class="service-list list-unstyled">
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#structuredFinanceModal">Structured Finance</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#swsAgreementModal">Preparation of Share and Warrants Subscription Agreement (SWSA)</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#shaAgreementModal">Preparation of Share Holders' Agreement (SHA)</a></li>
                <li class="mb-2"><i class="fa-solid fa-arrow-right text-secondary me-2"></i> <a href="#" data-bs-toggle="modal" data-bs-target="#dueDiligenceModal">Due Diligence</a></li>
            </ul>
        </div>
    </div>
</div>

 <div class="social-media d-flex flex-column position-fixed top-50 start-0 translate-middle-y">
    <a href="https://www.facebook.com/people/Investordekho-In/pfbid02sLfgh5o5aGRtkhhrP6TJUc9fhWrALinG7B6YEVP91HPA8jryUnNqpDpSMHaXpHwFl/" target="_blank" class="social-icon facebook d-flex align-items-center justify-content-center">
        <i class="fab fa-facebook-f"></i><span class="text ms-2">Facebook</span>
    </a>
    <a href="https://x.com/investordekho" target="_blank" class="social-icon twitter d-flex align-items-center justify-content-center">
        <i class="fa-solid fa-x"></i></span>
    </a>
    <a href="https://www.instagram.com/investor_dekho/" target="_blank" class="social-icon instagram d-flex align-items-center justify-content-center">
        <i class="fab fa-instagram"></i><span class="text ms-2">Instagram</span>
    </a>
    <a href="https://www.linkedin.com/in/investor-dekho-327689338/" target="_blank" class="social-icon linkedin d-flex align-items-center justify-content-center">
        <i class="fab fa-linkedin-in"></i><span class="text ms-2">LinkedIn</span>
    </a>
</div>

</div>
</div>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/includes/content.blade.php ENDPATH**/ ?>