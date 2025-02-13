/**
 * First, we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Uncomment if you're using Vue in your project
// window.Vue = require('vue');

// Example of a Vue component
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });

/**
 * CSRF Token Setup for Ajax Requests
 * This ensures that all outgoing Ajax requests include the CSRF token for Laravel's protection.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * General utility functions
 * You can add any global JavaScript functions below.
 */

// Example: a helper function for smooth scrolling
function scrollToElement(element) {
    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}

// Example of a click event handler
$(document).on('click', '.scroll-button', function() {
    const target = $(this).data('target');
    scrollToElement(target);
});

/**
 * Additional JavaScript code
 * Add any other logic that your project requires below.
 */

// Example: a custom form submission handler with validation
$('#myForm').on('submit', function(event) {
    event.preventDefault();
    
    // Example form validation logic
    let isValid = true;
    $(this).find('input, select').each(function() {
        if (!$(this).val()) {
            isValid = false;
            $(this).addClass('is-invalid'); // Add Bootstrap error class
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    if (isValid) {
        // Submit the form using Ajax
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                console.log('Form submitted successfully!');
            },
            error: function(error) {
                console.log('An error occurred:', error);
            }
        });
    } else {
        console.log('Please fill in all required fields.');
    }
});

/**
 * Example: Smooth Scroll to Top Button
 */
$(document).on('click', '#scrollTopButton', function() {
    $('html, body').animate({scrollTop: 0}, '300');
});
