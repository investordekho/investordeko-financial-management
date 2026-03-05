<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        // Auto-dismiss the alert after 4 seconds (4000 milliseconds)
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 4000);
    </script>
<?php endif; ?>


<!-- Hero Section -->
<section class="hero-banner" style="background: linear-gradient(135deg, #6c757d, #0dcaf0); color: white; padding: 60px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">Connect with <span style="color:rgb(234, 221, 75);">Investors</span> and <span style="color: #ffc107;">Startups</span></h1>
                <p style="font-size: 18px; margin-bottom: 30px;">Unlock opportunities for growth and innovation</p>
            </div>
            <div class="col-md-6 text-center">
                <?php if(auth()->guard()->guest()): ?>
                <div class="d-flex justify-content-center justify-content-md-start mt-4">
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

                <form class="d-flex justify-content-center justify-content-md-start mt-4" id="searchForm" method="POST" action="#" style="max-width: 600px;">
                    <?php echo csrf_field(); ?>
                    <input type="text" id="searchInput" name="search_query" placeholder="Search for Startups/Angel Investor/VC" style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px 0 0 5px;">
                    <button type="submit" style="padding: 10px 20px; background-color: #ffc107; border: none; border-radius: 0 5px 5px 0; color: white; font-weight: bold;">Search</button>
                </form>
                <?php else: ?>
                <div class="mt-4">
                    <a href="
                        <?php if(Auth::user()->category_id == 1): ?>
                            <?php echo e(route('investee.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 2): ?>
                            <?php echo e(route('investor.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 3): ?>
                            <?php echo e(route('investee.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 4): ?>
                            <?php echo e(route('investee.dashboard')); ?>

                        <?php else: ?>
                            <?php echo e(route('home')); ?>

                        <?php endif; ?>
                    " 
                    class="btn btn-professional"
                    style="padding: 10px 30px; font-size: 16px; font-weight: bold; border-radius: 50px; color: #fff;">
                        Go to Dashboard
                    </a>
                    <style>
                    .btn-professional {
                        background: linear-gradient(90deg, #0d6efd 0%, #343a40 100%);
                        background-size: 200% 100%;
                        background-position: left;
                        transition: background-position 0.5s, box-shadow 0.3s;
                        box-shadow: 0 4px 24px rgba(33,37,41,0.18);
                        position: relative;
                        overflow: hidden;
                        z-index: 1;
                        border: none;
                    }
                    .btn-professional::before {
                        content: '';
                        position: absolute;
                        left: -75%;
                        top: 0;
                        width: 50%;
                        height: 100%;
                        background: linear-gradient(120deg, rgba(255,255,255,0.10) 0%, rgba(255,255,255,0.03) 100%);
                        transform: skewX(-20deg);
                        z-index: 2;
                        pointer-events: none;
                        transition: left 0.5s;
                    }
                    .btn-professional.professional-animate {
                        background-position: right;
                        box-shadow: 0 8px 32px rgba(52,58,64,0.18);
                    }
                    .btn-professional.professional-animate::before {
                        left: 120%;
                    }
                    </style>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const btn = document.querySelector('.btn-professional');
                        setInterval(() => {
                            btn.classList.add('professional-animate');
                            setTimeout(() => btn.classList.remove('professional-animate'), 900);
                        }, 2500);
                    });
                    </script>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 
<section class="hero-banner" style="background: linear-gradient(135deg, #6c757d, #0dcaf0); color: white; padding: 60px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h1 style="font-size: 48px; font-weight: bold; margin-bottom: 20px;">Connect with <span style="color: #28a745;">Investors</span> and <span style="color: #ffc107;">Startups</span></h1>
                <p style="font-size: 18px; margin-bottom: 30px;">Unlock opportunities for growth and innovation</p>

             
            </div>
            <div class="col-md-6 text-center">

                   <?php if(auth()->guard()->guest()): ?>
                <div class="d-flex justify-content-center justify-content-md-start mt-4">
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

                <form class="d-flex justify-content-center justify-content-md-start mt-4" id="searchForm" method="POST" action="#" style="max-width: 600px;">
                    <?php echo csrf_field(); ?>
                    <input type="text" id="searchInput" name="search_query" placeholder="Search for Startups/Angel Investor/VC" style="flex: 1; padding: 10px; border: none; border-radius: 5px 0 0 5px;">
                    <button type="submit" style="padding: 10px 20px; background-color: #ffc107; border: none; border-radius: 0 5px 5px 0; color: white; font-weight: bold;">Search</button>
                </form>
                <?php else: ?>
                <div class="mt-4">
                    <a href="
                        <?php if(Auth::user()->category_id == 1): ?>
                            <?php echo e(route('investee.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 2): ?>
                            <?php echo e(route('investor.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 3): ?>
                            <?php echo e(route('banker.dashboard')); ?>

                        <?php elseif(Auth::user()->category_id == 4): ?>
                            <?php echo e(route('banker.dashboard')); ?>

                        <?php else: ?>
                            <?php echo e(route('home')); ?>

                        <?php endif; ?>
                    " class="btn btn-light" style="padding: 10px 30px; font-size: 16px; font-weight: bold; border-radius: 50px; background-color: #28a745; color: white;">Go to Dashboard</a>
                </div>
                <?php endif; ?>
                
              
            </div>
        </div>
    </div>
</section> -->





































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

                // Redirect to the constructed URL feeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
                window.location.href = redirectUrl;
            });
        }
    });
</script>























<!-- Services Section -->
<section class="services-section py-5" style="background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%); animation: fadeIn 1.2s;">
    <div class="container">
        <?php if(auth()->guard()->guest()): ?>
       <div class="row justify-content-center" style="padding: 10 15px 10px 10px; margin-bottom: 60px;">
    <div class="col-md-5 mb-4" style="padding: 10 15px 10px 10px; margin-bottom: 40px;"> 
        <div class="card h-100 border-0 shadow-lg text-center service-flap animate-flap flip-card" style="padding: 10 15px 10px 10px; height: 100%;">
            <div class="flip-card-inner" style="height: 100%;">
                <div class="flip-card-front card-body" style="padding: 2rem;">
                    <i class="fa-solid fa-user-tie mb-2 text-primary" style="font-size: 1.5rem;"></i>
                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1rem;">Find Investors</h5>
                    <p class="card-text mb-3 text-muted" style="font-size: 0.85rem; margin-bottom: 1rem;">Connect with verified angel investors, VCs, and funding partners to accelerate your startup's growth.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary px-3 fw-semibold" style="font-size: 0.85rem;">Browse Investors</a>
                </div>
                <div class="flip-card-back card-body" style="padding: 2rem;">
                    <i class="fa-solid fa-handshake mb-2 text-primary" style="font-size: 1.5rem;"></i>
                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1rem;">Why Join?</h5>
                    <p class="card-text mb-3 text-muted" style="font-size: 0.85rem; margin-bottom: 1rem;">Access a curated investor network and receive expert fundraising guidance for your business.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary px-3 fw-semibold" style="font-size: 0.85rem;">Join Now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 mb-4" style="padding: 0 15px;">
        <div class="card h-100 border-0 shadow-lg text-center service-flap animate-flap flip-card" style="height: 100%;">
            <div class="flip-card-inner" style="height: 100%;">
                <div class="flip-card-front card-body" style="padding: 2rem;">
                    <i class="fa-solid fa-lightbulb mb-2 text-success" style="font-size: 1.5rem;"></i>
                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1rem;">Find Startups</h5>
                    <p class="card-text mb-3 text-muted" style="font-size: 0.85rem; margin-bottom: 1rem;">Discover innovative startups and unlock exclusive investment opportunities tailored for you.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-success px-3 fw-semibold" style="font-size: 0.85rem;">Browse Startups</a>
                </div>
                <div class="flip-card-back card-body" style="padding: 2rem;">
                    <i class="fa-solid fa-rocket mb-2 text-success" style="font-size: 1.5rem;"></i>
                    <h5 class="card-title mb-2 fw-bold" style="font-size: 1rem;">Why Invest?</h5>
                    <p class="card-text mb-3 text-muted" style="font-size: 0.85rem; margin-bottom: 1rem;">Diversify your portfolio and support high-growth ventures with verified business insights.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-success px-3 fw-semibold" style="font-size: 0.85rem;">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile-only adjustments -->
<style>
@media (max-width: 767px) {
    .flip-card-front.card-body,
    .flip-card-back.card-body {
        padding: 1rem !important;
    }

    .card-title {
        font-size: 0.95rem !important;
    }

    .card-text {
        font-size: 0.8rem !important;
    }

    .btn {
        font-size: 0.8rem !important;
        padding: 6px 12px !important;
    }

    i[class^="fa-"] {
        font-size: 1.25rem !important;
    }

    .col-md-5 {
        width: 90% !important;
        margin: 0 auto !important;
    }
}
</style>

        <?php endif; ?>
    </div>
</section>
<style>
/* Prevent body shift when modal opens by always showing vertical scrollbar */
body {
    overflow-y: scroll !important;
}

/* Ensure fixed elements like navbar and social-media stay above modals/popups */
.navbar,
.social-media {
    z-index: 1100 !important;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: translateY(0);}
}
.service-flap {
    background: #fff;
    border-radius: 18px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    perspective: 1000px;
    overflow: hidden;
    height: 240px;
    min-height: 240px;
    max-height: 240px;
    display: flex;
    flex-direction: column;
    justify-content: stretch;
}
.service-flap .card-body {
    padding: 1.5rem 1.2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.service-flap:hover {
    transform: translateY(-8px) scale(1.04) rotate(-1deg);
    box-shadow: 0 16px 40px rgba(0,0,0,0.14);
}
.animate-flap {
    animation: fadeIn 1.2s;
}
.flip-card {
    perspective: 1200px;
    height: 100%;
}
.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 100%;
    transition: transform 0.8s cubic-bezier(.4,2,.6,1);
    transform-style: preserve-3d;
}
.flip-card.flipped .flip-card-inner {
    transform: rotateY(180deg);
}
.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    min-height: 100%;
    backface-visibility: hidden;
    border-radius: 18px;
    top: 0;
    left: 0;
}
.flip-card-back {
    transform: rotateY(180deg);
    background: #f8fafc;
}
@media (max-width: 767px) {
    .service-flap {
        height: 180px;
        min-height: 180px;
        max-height: 180px;
    }
    .service-flap .card-body {
        padding: 0.7rem 0.5rem;
    }
}
</style>
<style>
@media (max-width: 767px) {
    .services-section .col-md-5:first-child {
        margin-bottom: 1.5rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flipCards = document.querySelectorAll('.flip-card');
    setInterval(() => {
        flipCards.forEach(card => card.classList.toggle('flipped'));
    }, 4500);
});
</script>









































<!-- scrolling text  related to services -zm,xxxxxxxxxxxxxxxxxxxxxxxxxxxsf dnsjuiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiizncfp[00yyyyyyyyyyyyyyyyyyyyyyyyhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh-->
<!-- Professional Scrolling Info Bar -->
<?php
    // Dynamic messages for the scrolling info bar
    $scrollingMessages = [
        [
            'icon' => 'fa-rocket text-primary',
            'text' => 'Startup Discovery',
            'badge' => 'New',
            'badgeColor' => 'info'
        ],
        [
            'icon' => 'fa-handshake-angle text-success',
            'text' => 'Investor Connections',
            'badge' => null,
            'badgeColor' => null
        ],
        [
            'icon' => 'fa-shield-check text-warning',
            'text' => 'Verified: Startups, Investors, VCs',
            'badge' => 'Verified',
            'badgeColor' => 'success'
        ],
        [
            'icon' => 'fa-headset text-secondary',
            'text' => '24x7 Support',
            'badge' => null,
            'badgeColor' => null
        ],
        [
            'icon' => 'fa-fire text-danger',
            'text' => 'Hot: IPO Planning & Listing',
            'badge' => 'Hot',
            'badgeColor' => 'danger'
        ],
        [
            'icon' => 'fa-lightbulb text-warning',
            'text' => 'Pitchdeck & Fundraising Guidance',
            'badge' => null,
            'badgeColor' => null
        ],
        [
            'icon' => 'fa-gavel text-primary',
            'text' => 'Legal & Compliance Services',
            'badge' => null,
            'badgeColor' => null
        ],
    ];
?>

<div class="container-fluid py-2 scrolling-info-bar shadow-sm" style="background: linear-gradient(90deg, #f8fafc 0%, #e9ecef 100%); border-bottom: 1px solid #dee2e6; position: relative; z-index: 1050;">
    <div class="row align-items-center justify-content-between">
        <div class="col-12 col-md-10 px-0">
            <div class="scrolling-text-wrapper overflow-hidden position-relative" style="height: 2.1rem;">
                <span id="scrolling-text" class="d-inline-block" style="white-space: nowrap; font-size: 1.05rem; font-weight: 500; color: #22223b; letter-spacing: 0.01em; animation: scroll-left 32s linear infinite;">
                    <span class="fw-bold text-uppercase me-2" style="color:#0dcaf0;">
                        <i class="fa-solid fa-circle-info me-1"></i> InvestorDekho
                    </span>
                    <span class="mx-2 text-secondary">|</span>
                    <?php $__currentLoopData = $scrollingMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="me-3">
                            <i class="fa-solid <?php echo e($msg['icon']); ?> me-1"></i>
                            <?php echo e($msg['text']); ?>

                            <?php if($msg['badge']): ?>
                                <span class="badge bg-<?php echo e($msg['badgeColor']); ?> ms-1" style="font-size:0.75em;vertical-align:middle;"><?php echo e($msg['badge']); ?></span>
                            <?php endif; ?>
                        </span>
                        <span class="mx-2 text-secondary">|</span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <span class="me-2">
                        <i class="fa-solid fa-bolt text-warning me-1"></i>
                        <span class="d-none d-md-inline">Get a free consultation today!</span>
                    </span>
                </span>
            </div>
        </div>
        <div class="col-auto d-none d-md-flex align-items-center">
            <a href="<?php echo e(route('contact')); ?>" class="btn btn-gradient px-3 py-1 rounded-pill shadow-sm ms-2" style="font-weight: 500; font-size: 1.01rem;">
                <i class="fa-solid fa-headset me-2"></i>Contact Us
            </a>
            <!-- <button id="close-scrolling-bar" class="btn btn-link text-muted ms-2 p-0" style="font-size:1.3rem;" aria-label="Dismiss info bar">
                <i class="fa-solid fa-xmark"></i>
            </button> -->
        </div>
    </div>
</div>
<style>
    @keyframes scroll-left {
        0% { transform: translateX(100%);}
        100% { transform: translateX(-110%);}
    }
    #scrolling-text {
        transition: background 0.2s, color 0.2s;
        cursor: pointer;
    }
    #scrolling-text:hover {
        animation-play-state: paused;
        color: #0dcaf0;
        background: rgba(13,202,240,0.08);
        border-radius: 8px;
        padding: 0 8px;
    }
    .scrolling-text-wrapper {
        height: 2.1rem;
        display: flex;
        align-items: center;
        background: transparent;
    }
    .scrolling-info-bar {
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        font-size: 1.05rem;
        letter-spacing: 0.01em;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        z-index: 1050 !important;
        position: relative;
        transition: top 0.3s;
    }
    .btn-gradient {
        background: linear-gradient(90deg, #0dcaf0 0%, #0d6efd 100%);
        color: #fff;
        border: none;
        font-weight: 600;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(13,202,240,0.08);
    }
    .btn-gradient:hover, .btn-gradient:focus {
        background: linear-gradient(90deg, #0d6efd 0%, #0dcaf0 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(13,202,240,0.18);
        text-decoration: none;
    }
    #close-scrolling-bar {
        background: none;
        border: none;
        outline: none;
        box-shadow: none;
        color: #adb5bd;
        transition: color 0.2s;
    }
    #close-scrolling-bar:hover {
        color: #0dcaf0;
    }
    @media (max-width: 991.98px) {
        .scrolling-info-bar {
            font-size: 0.97rem;
            border-radius: 0 0 8px 8px;
        }
        .scrolling-text-wrapper {
            height: 1.5rem;
        }
    }
    @media (max-width: 767.98px) {
        .scrolling-info-bar .col-auto {
            display: none !important;
        }
        #scrolling-text {
            font-size: 0.89rem;
        }
        .scrolling-text-wrapper {
            height: 1.1rem;
        }
    }
    .social-media {
        z-index: 1100 !important;
        position: fixed !important;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }
</style>
<script>
    // Dismiss/close button for info bar
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.getElementById('close-scrolling-bar');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                const bar = document.querySelector('.scrolling-info-bar');
                if (bar) bar.style.display = 'none';
            });
        }
        // Pause on hover for accessibility
        const scrollingText = document.getElementById('scrolling-text');
        if (scrollingText) {
            scrollingText.addEventListener('mouseenter', () => {
                scrollingText.style.animationPlayState = 'paused';
            });
            scrollingText.addEventListener('mouseleave', () => {
                scrollingText.style.animationPlayState = 'running';
            });
        }
    });
</script>

<!-- Suggestions:
1. Make the scrolling text dynamic by using a PHP array and Blade to loop through messages.
2. Add an optional dismiss/close button for user control.
3. Consider ARIA roles for accessibility: role="status" or aria-live="polite".
4. Add a small icon or badge for "New" or "Hot" services.
5. If you have urgent news, allow a red/alert color variant.
6. For mobile, consider a tap-to-pause or tap-to-expand for better UX.
-->





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
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/fr2.jpg')); ?>" alt="Fund Raising" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> 
            
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center" style="width: 100%;">
                <span class="me-2"><i class="fa-solid fa-hands-holding-circle text-primary"></i></span> Fund Raising
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#equityFundingModal" class="text-decoration-none text-dark">
                        Equity Funding
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#debtFundingModal" class="text-decoration-none text-dark">
                        Debt Funding
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#maModal" class="text-decoration-none text-dark">
                        M&amp;A
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#piModal" class="text-decoration-none text-dark">
                        Pitchdeck
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#piiModal" class="text-decoration-none text-dark">
                        Pitching
                    </a>
                </li>
            </ul>
        </div>


        
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/ipo5.jpg')); ?>" alt="Public Offering" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> <!-- Spacer to push content below the image -->
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center" style="width: 100%;">
                <span class="me-2"><i class="fa-solid fa-chart-line text-success"></i></span> Public Offering   
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ipoPlanningModal" class="text-decoration-none text-dark">
                        IPO Planning
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ipoListingModal" class="text-decoration-none text-dark">
                        IPO Listing
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#bonusSharesModal" class="text-decoration-none text-dark">
                        Issuance of Bonus Shares
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#rightsIssueModal" class="text-decoration-none text-dark">
                        Issuance of Rights Issue
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#esopPlanningModal" class="text-decoration-none text-dark">
                        Employee Stock Options (ESOP) Planning
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/rs4.jpg')); ?>" alt="Intellectual Property and Legal Services" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> <!-- Spacer to push content below the image -->
            
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center">
                <span class="me-2"><i class="fa-solid fa-gavel text-warning"></i></span> Intellectual Property and Legal Services
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#patentModal" class="text-decoration-none text-dark">
                        Patent
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#trademarkModal" class="text-decoration-none text-dark">
                        Trademark
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#designRegistrationModal" class="text-decoration-none text-dark">
                        Design Registration
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#dscModal" class="text-decoration-none text-dark">
                        DSC
                    </a>
                </li>
                <!-- <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#onlineListingModal" class="text-decoration-none text-dark">
                        Online Listing
                    </a>
                </li> -->
            </ul>
        </div>
    </div>





    
    <div class="row mt-4">
     <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/compliance2.jpg')); ?>" alt="Compliance and Regulatory Services" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> <!-- Spacer to push content below the image -->
            
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center">
                <span class="me-2"><i class="fa-solid fa-file-alt text-secondary"></i></span> Compliance and Regulatory Services
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                <!-- <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#incomeTaxModal" class="text-decoration-none text-dark">
                        Income Tax Return
                    </a>
                </li> -->
                <!-- <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#gstCustomsModal" class="text-decoration-none text-dark">
                        GST, TDS, PF, ESI, PT, Customs
                    </a>
                </li> -->
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#mcaRocWorksModal" class="text-decoration-none text-dark">
                        MCA & ROC Works
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#appointmentResignationModal" class="text-decoration-none text-dark">
                        Appointment & Resignation of Directors
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#annualReturnModal" class="text-decoration-none text-dark">
                        Annual Return
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#companyRegistrationModal" class="text-decoration-none text-dark">
                        Company Registration
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#udyogAadhaarGstModal" class="text-decoration-none text-dark">
                        Udyog Aadhaar & GST Registration
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#importerExporterCodeModal" class="text-decoration-none text-dark">
                        Importer-Exporter Code
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/as2.jpg')); ?>" alt="Financial and Accounting Advisory" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> <!-- Spacer to push content below the image -->
            
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center" style="width: 100%;">
                <!-- <span class="me-2"><i class="fa-solid fa-file-invoice-dollar text-success"></i></span> Financial and Accounting Services -->
                 <span class="me-2"><i class="fa-solid fa-file-invoice-dollar text-success"></i></span> Financial Services
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                 <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loanProposalModal" class="text-decoration-none text-dark">
                        Loan Proposal
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cmaDataModal" class="text-decoration-none text-dark">
                        CMA Data
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#accountingModal" class="text-decoration-none text-dark">
                        Accounting Advisory
                    </a>
                </li>
                <!-- <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#subsidyModal" class="text-decoration-none text-dark">
                        Subsidy
                    </a>
                </li> -->
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#taxPlanningModal" class="text-decoration-none text-dark">
                        Tax Planning
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#capitalReStructuringModal" class="text-decoration-none text-dark">
                        Capital Re-Structuring
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#projectReportModal" class="text-decoration-none text-dark">
                        Project Report
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tevStudyModal" class="text-decoration-none text-dark">
                        TEV Study Advisory
                    </a>        
                </li>
            </ul>
        </div>
        <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded-4 shadow-sm d-flex flex-column align-items-center text-center" style="border-radius: 40px; position: relative;">
            <div class="w-100 mb-3" style="
                position: absolute;
                left: 0;
                right: 0;
                top: -23px;
                height: 160px;
                overflow: hidden;
                border-radius: 20px 20px 0px 0px;
                margin-left: 0;
                margin-right: 0;
                z-index: 2;
            ">
                <img src="<?php echo e(asset('storage/screenshots/as5.jpg')); ?>" alt="Other Services" class="img-fluid w-100 h-100" style="object-fit:cover; border-radius:20px 20px 0 0;">
            </div>
            <div style="height: 140px;"></div> <!-- Spacer to push content below the image -->
            
            <h5 class="service-title mb-3 d-flex align-items-center justify-content-center" style="width: 100%;">
                <span class="me-2"><i class="fa-solid fa-cogs text-secondary"></i></span> Other Services
            </h5>
            <ul class="service-list list-unstyled text-start w-100">
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#structuredFinanceModal" class="text-decoration-none text-dark">
                        Structured Finance
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#businessValuationModal" class="text-decoration-none text-dark">
                        Business Valuation
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#dueDiligenceModal" class="text-decoration-none text-dark">
                        Due Diligence
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#financialModellingModal" class="text-decoration-none text-dark">
                        Financial Modelling
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</div>
        <!-- </div>
        </div>
        </div>
        </div> -->

        <!-- <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
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
        </div> -->

        <!-- <div class="col-sm-4 service-box p-4 mb-4 bg-light rounded shadow-sm">
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
        </div> -->
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
    <a href="https://www.linkedin.com/in/investor-dekho-ad-327689338/" target="_blank" class="social-icon linkedin d-flex align-items-center justify-content-center">
        <i class="fab fa-linkedin-in"></i><span class="text ms-2">LinkedIn</span>
    </a>
     <a href="https://www.youtube.com/@InvestorDekho" target="_blank" class="social-icon linkedin d-flex align-item-center justify-content-center">
         <i class="bi bi-youtube"></i><span class="text ms-2">Youtube</span>
     </a>
</div>

</div>
</div>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/includes/content.blade.php ENDPATH**/ ?>