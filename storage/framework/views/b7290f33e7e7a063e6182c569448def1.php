<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h2 class="text-white mb-4">Our Office</h2>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://x.com/investordekho"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.facebook.com/profile.php?id=61568901415594"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.youtube.com/@InvestorDekho"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href="https://www.linkedin.com/in/investor-dekho-327689338/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
               <div class="col-lg-4 col-md-6">
    <h2 class="text-white mb-4">Services</h2>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Fund Raising</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Public Offering</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Intellectual Property and Legal Services</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Compliance and Regulatory Services</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Financial and Accounting Services</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Others</a>
</div>

<div class="col-lg-4 col-md-6">
    <h2 class="text-white mb-4">Quick Links</h2>
    <a class="btn btn-link" href="<?php echo e(route('about')); ?>">About Us</a>
    <a class="btn btn-link" href="<?php echo e(route('contact')); ?>">Contact Us</a>
    <a class="btn btn-link" href="<?php echo e(route('services')); ?>">Our Services</a>
    <a class="btn btn-link" href="<?php echo e(route('terms')); ?>">Terms & Conditions</a>
    <a class="btn btn-link" href="<?php echo e(route('support')); ?>">Support</a>
    <a href="<?php echo e(route('privacy-policy')); ?>" class="btn btn-link">Privacy</a>
</div>

</div>

               <!-- <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-white border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Investordekho</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    
                  
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for various plugins like Owl Carousel, WOW.js, and others) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- WOW.js (for animations) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <!-- Waypoints (required for CounterUp) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>

    <!-- CounterUp (correct CDN for version 2.1.0) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>

    <!-- Initialize any plugins or custom scripts after all dependencies are loaded -->
    <script>
        $(document).ready(function() {
            // Initialize Owl Carousel
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 3000,
                dots: true
            });

            // Initialize CounterUp
            $('.counter').counterUp({
                delay: 10,   // Delay in milliseconds between each count increment
                time: 1000   // Total duration of the counter animation in milliseconds
            });

            // Initialize WOW.js for animations
            new WOW().init();
        });
    </script>

    <!-- Main Custom JS file -->
    <script src="<?php echo e(asset('dashboard/js/main.js')); ?>"></script> <!-- Make sure this file exists -->

    <!-- Custom JavaScript for dropdown menu functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.querySelector('#servicesDropdown');
            dropdown.addEventListener('click', function(e) {
                var menu = this.nextElementSibling;
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                } else {
                    menu.classList.add('show');
                }
                e.preventDefault();
            });
        });
    </script>

    <!-- Additional Scripts -->

    <script src="<?php echo e(asset('js/main.js')); ?>"></script> <!-- Your custom main JavaScript -->
</body>
</html>



<?php /**PATH C:\xampp\htdocs\laravel_data\resources\views/includes/footer.blade.php ENDPATH**/ ?>