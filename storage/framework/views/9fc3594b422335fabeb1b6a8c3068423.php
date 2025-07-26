<?php $__env->startSection('content'); ?>


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-4 animated slideInDown">Contact</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Contact</p>
                <h1 class="display-5 mb-4">If You Have Any Query, Please Contact Us</h1>

                <!-- Display success or error messages -->
                <?php if(session('successMessage')): ?>
                    <div class="alert alert-success" role="alert" id="success-alert-message">
                        <?php echo e(session('successMessage')); ?>

                    </div>

                    <script>
                        // Wait for DOM to load
                        document.addEventListener('DOMContentLoaded', function () {
                            const successAlert = document.getElementById('success-alert-message');
                            if (successAlert) {
                                setTimeout(() => {
                                    successAlert.style.display = 'none';
                                }, 3000); // 5000ms = 5 seconds
                            }
                        });
                    </script>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success" id="success-alert">
                        <?php echo e(session('success')); ?>

                    </div>

                    <script>
                        // Wait for DOM to load
                        document.addEventListener('DOMContentLoaded', function () {
                            const successAlert = document.getElementById('success-alert');
                            if (successAlert) {
                                setTimeout(() => {
                                    successAlert.style.display = 'none';
                                }, 3000); // 5000ms = 5 seconds
                            }
                        });
                    </script>
                <?php endif; ?>

                <form action="<?php echo e(route('contact.submit')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                       <!-- Name Field -->
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                id="name"
                                name="name"
                                placeholder="Your Name"
                                pattern="[A-Za-z\s]+"
                                value="<?php echo e(old('name')); ?>"
                                required>
                            <label for="name">Your Name</label>
                        </div>
                        <?php if($errors->has('name')): ?>
                            <div class="text-danger mt-1 small"><?php echo e($errors->first('name')); ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Email Field -->
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <input type="email"
                                class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>"
                                id="email"
                                name="email"
                                placeholder="Your Email"
                                value="<?php echo e(old('email')); ?>"
                                required>
                            <label for="email">Your Email</label>
                        </div>
                        <?php if($errors->has('email')): ?>
                            <div class="text-danger mt-1 small"><?php echo e($errors->first('email')); ?></div>
                        <?php endif; ?>
                    </div>


                        <!-- Subject Field -->
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <!-- <input type="text" 
                                    class="form-control" 
                                    id="subject" 
                                    name="subject" 
                                    placeholder="Subject" 
                                    required> -->
                                    <input type="text" 
                                    class="form-control <?php echo e($errors->has('subject') ? 'is-invalid' : ''); ?>" 
                                    id="subject" 
                                    name="subject" 
                                    placeholder="Subject" 
                                    value="<?php echo e(old('subject')); ?>" 
                                    required>

                                <label for="subject">Subject</label>
                            </div>
                        </div>

                        <!-- Message Field -->
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <!-- <textarea class="form-control" 
                                        placeholder="Leave a message here" 
                                        id="message" 
                                        name="message" 
                                        style="height: 100px" 
                                        required></textarea> -->
                                        <textarea class="form-control <?php echo e($errors->has('message') ? 'is-invalid' : ''); ?>" 
                                        placeholder="Leave a message here" 
                                        id="message" 
                                        name="message" 
                                        style="height: 100px" 
                                        required><?php echo e(old('message')); ?></textarea>

                                <label for="message">Message</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                <div class="position-relative rounded overflow-hidden h-100">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.9290423277475!2d72.86001467440553!3d19.110768582100988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c83767d867ab%3A0x98e3117f0fb5a6b!2sRajveer%20Royals!5e0!3m2!1sen!2sin!4v1727935929902!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<script>
document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const fullNameInput = document.getElementById("name");
    const allInputs = document.querySelectorAll("input, select, textarea, button");

    const emailError = document.createElement("div");
    emailError.className = "text-danger mt-1";
    // emailInput.parentNode.appendChild(emailError);
    // emailInput.insertAdjacentElement("afterend", emailError);

    const nameError = document.createElement("div");
    nameError.className = "text-danger mt-1";
    // fullNameInput.parentNode.appendChild(nameError);
    // fullNameInput.insertAdjacentElement("afterend", nameError);


    emailInput.closest('.form-floating').insertAdjacentElement("afterend", emailError);
    fullNameInput.closest('.form-floating').insertAdjacentElement("afterend", nameError);


    const emailPattern = /^[a-zA-Z0-9._%+-]+@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;
    const namePattern = /^[A-Za-z\s]+$/;

    function validateEmail() {
        const value = emailInput.value.trim();
        if (!emailPattern.test(value)) {
            emailInput.classList.add("is-invalid");
            emailError.textContent = "Enter a valid email like example@gmail.com";
            //decrease size of text content
            emailError.style.fontSize = "0.8rem";
            return false;
        } else {
            emailInput.classList.remove("is-invalid");
            emailError.textContent = "";
            return true;
        }
    }

    function validateName() {
        const nameVal = fullNameInput.value.trim();
        if (nameVal === "") {
            fullNameInput.classList.add("is-invalid");
            nameError.textContent = "Full name is required.";
            return false;
        }
        if (!namePattern.test(nameVal)) {
            fullNameInput.classList.add("is-invalid");
            nameError.textContent = "Full name must contain only letters and spaces.";
            //decrease size of text content
            nameError.style.fontSize = "0.8rem";
            return false;
        } 
        else {
            fullNameInput.classList.remove("is-invalid");
            nameError.textContent = "";
            return true;
        }
    }

    fullNameInput.addEventListener("blur", function () {
        if (!validateName()) {
            fullNameInput.focus();
        }
    });

    emailInput.addEventListener("blur", function () {
        if (!validateEmail()) {
            emailInput.focus();
        }
    });

    emailInput.addEventListener("input", validateEmail);
    fullNameInput.addEventListener("input", validateName);
});
</script>

<script>
    const emojiRegex = /([\u2700-\u27BF]|[\uE000-\uF8FF]|\u24C2|[\uD83C-\uDBFF\uDC00-\uDFFF])/g;

    const subjectInput = document.getElementById('subject');
    const messageInput = document.getElementById('message');

    // Remove emojis from Subject
    subjectInput.addEventListener('input', function () {
        if (emojiRegex.test(this.value)) {
            this.value = this.value.replace(emojiRegex, '');
            this.setCustomValidity("Subject cannot contain emojis.");
            this.reportValidity();
        } else {
            this.setCustomValidity("");
        }
    });

    // Remove emojis from Message
    messageInput.addEventListener('input', function () {
        if (emojiRegex.test(this.value)) {
            this.value = this.value.replace(emojiRegex, '');
            this.setCustomValidity("Message cannot contain emojis.");
            this.reportValidity();
        } else {
            this.setCustomValidity("");
        }
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views/contact.blade.php ENDPATH**/ ?>