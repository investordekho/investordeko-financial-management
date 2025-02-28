<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomRegistrationController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\InvesteeDashboardController;
use App\Http\Controllers\InvestorDashboardController;
use App\Http\Controllers\BankerDashboardController;
use App\Http\Controllers\OtherDashboardController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\BankerController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LocationDetailnewController;
use App\Http\Controllers\SectorDetailnewController;
use App\Http\Controllers\ServiceContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\ExcelUploadController;

// Home, About, Services, Contact Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy-policy');

// Contact Form Submission Route
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Location and Sector Routes
Route::get('/locations', [LocationDetailnewController::class, 'getLocations']);
Route::get('/sectors', [SectorDetailnewController::class, 'getSectors']);

// Form Routes
Route::get('/form/investee', [FormController::class, 'showInvesteeForm'])->name('form.investee');
Route::get('/form/investor', [FormController::class, 'showInvestorForm'])->name('form.investor');
Route::get('/form/banker', [FormController::class, 'showBankerForm'])->name('form.banker');
Route::get('/form/other', [OtherController::class, 'showOtherForm'])->name('form.other');

// Form Submission Routes
Route::post('/form-submit', [FormSubmissionController::class, 'store'])->name('form.submit');
Route::post('/form/investor-submit', [FormController::class, 'submitInvestorForm'])->name('form.investor.submit');
Route::post('/other-form/submit', [OtherController::class, 'submitOtherForm'])->name('form.other.submit');

// Search Routes
Route::get('/banker/investee/search', [DashboardController::class, 'searchInvestee'])->name('banker.investee.search');
Route::get('/banker/investor/search', [DashboardController::class, 'searchInvestor'])->name('banker.investor.search');
Route::post('/dashboard/investor/search', [InvestorDashboardController::class, 'search'])->name('investor.search');
Route::post('/dashboard/investee/search', [InvesteeDashboardController::class, 'search'])->name('investee.search');

// Bank Form Routes
Route::get('/form/bank', [FormController::class, 'showBankerForm'])->name('form.bank');
Route::post('/form/bank-submit', [BankerController::class, 'store'])->name('form.bank.submit');
Route::get('/banker/form', [FormController::class, 'showBankerForm'])->name('form.banker.form');
Route::post('/banker/form', [BankerController::class, 'submitForm'])->name('form.banker.submit');

// Filter Routes
Route::get('/filter/investees', [BankerController::class, 'filterInvestees'])->name('filter.investees');
Route::get('/filter/investors', [BankerController::class, 'filterInvestors'])->name('filter.investors');
Route::post('/filter/banker/investors', [BankerController::class, 'searchinvestor'])->name('filter.banker.investors');
Route::post('/filter/banker-investees', [BankerController::class, 'search'])->name('filter.banker.investees');

// Order Routes
Route::get('/order', [OrderController::class, 'showOrderPage'])->name('order');
Route::post('/process-order', [OrderController::class, 'processOrder'])->name('processOrder');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/settings', [ProfileController::class, 'showProfileSettings'])->name('profile.settings');
Route::post('/profile/update', [ProfileController::class, 'updateProfileSettings'])->name('profile.update');

// Authentication Routes (Login, Logout, and Registration)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [CustomRegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomRegistrationController::class, 'register']);

// OTP Verification Routes
Route::get('/verify-otp', [OTPController::class, 'showOtpForm'])->name('otp.form');
Route::post('/verify-otp', [OTPController::class, 'verifyOtp'])->name('otp.verify');

// Subscription Routes
Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');

// Dashboard Routes for different categories (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        Log::info('User Category ID: ' . $user->category_id);  // Debugging user category

        // Check the category_id field in the users table and redirect accordingly
        switch ($user->category_id) {
            case 1:
                return redirect()->route('investee.dashboard');
            case 2:
                return redirect()->route('investor.dashboard');
            case 3:
                return redirect()->route('banker.dashboard');
            case 4:
                return redirect()->route('other.dashboard');
            default:
                return redirect()->route('home')->with('error', 'Invalid category.');
        }
    })->name('dashboard');

    Route::get('/dashboard/investee', [InvesteeDashboardController::class, 'index'])->name('investee.dashboard');
    Route::get('/dashboard/investor', [InvestorDashboardController::class, 'index'])->name('investor.dashboard');
    Route::get('/dashboard/banker', [BankerController::class, 'showBankerDashboard'])->name('banker.dashboard');
    Route::get('/dashboard/other', [OtherDashboardController::class, 'index'])->name('other.dashboard');

    Route::get('/dashboard/admin', [AdminDashboard::class,'callAdminDashboard'])->name('admin.dashboard');
    // Route::post('/investor/excelupload', [ExcelUploadController::class, 'exceluploadinvestor'])->name('investor.excelupload');
});
Route::post('/investor/excelupload', [ExcelUploadController::class, 'exceluploadinvestor'])->name('investor.excelupload');
// Route::post('/investor/excelupload', [ExcelUploadController::class, 'exceluploadinvestor'])->name('investor.excelupload');
// Search Submission Route
Route::post('/perform-search', [SearchController::class, 'performSearch'])->name('perform.search');

// Route for non-logged-in dashboard (common)
Route::get('dashboard.dashboard', [DashboardController::class, 'show'])->name('dashboard.show');

// Default Laravel Auth Routes
Auth::routes();

// Service Contact Form Routes
Route::get('/service-contact', [ServiceContactController::class, 'showContactForm'])->name('service.contact.form');
Route::post('/service-contact', [ServiceContactController::class, 'submitContactForm'])->name('service.contact.submit');

Route::get('/captcha', [CaptchaController::class, 'generateCaptcha']);
