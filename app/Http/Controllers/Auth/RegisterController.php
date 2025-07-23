<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Rules\CaptchaMatch;
use App\Http\Controllers\OTPController;
use App\Services\OtpService;
class RegisterController extends Controller
{
    // Add the ValidatesRequests trait to your controller
    use ValidatesRequests;

    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    // public function showRegistrationForm()
    // {
    //     // Generate captcha numbers and store in session
    //     $num1 = rand(1, 10);
    //     $num2 = rand(1, 10);
    //     session(['captcha_value_1' => $num1, 'captcha_value_2' => $num2]);

    //     // Fetch categories for the registration form
    //     $categories = Category::all();

    //     return view('auth.register', compact('categories', 'num1', 'num2'));
    // }

    public function showRegistrationForm()
    {
        // Fetch categories from the database
        $categories = Category::all();
        $numchar ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $num1 = substr(str_shuffle($numchar), 0, 6);
       
        // Store the CAPTCHA values in session
        session(['captcha_value_1' => $num1]);

        // Pass the categories and CAPTCHA values to the view
        return view('auth.register', compact('categories', 'num1'));
    }


    public function register(Request $request)
    {
        // Validate the form fields
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'category' => 'required',
            // 'captcha' => ['required', new CaptchaMatch(session('captcha_value_1'))],
            'captcha'   => ['required', function ($attribute, $value, $fail) {
                if ($value !== session('captcha_text')) {
                    $fail('The CAPTCHA is incorrect.');
                }
            }],
            'terms' => 'accepted',
        ]);

        // // Manually validate captcha
        // $num1 = session('captcha_value_1');
        // $num2 = session('captcha_value_2');
        // $correctCaptcha = $num1 + $num2;

        // if ($request->captcha != $correctCaptcha) {
        //     return back()->withErrors(['captcha' => 'The entered captcha is incorrect'])->withInput();
        // }

        //combine phone and country_code_input
        $phone = $request->country_code.$request->phone;
        // Create the user
    

        // Store OTP (default 123456) in session
        // Generate OTP and send
        $otp = rand(100000, 999999);
        $otpsend = $this->otpService->sendOtp($request->phone, $otp);
        $user = null;
        if($otpsend['return']){
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'password' => Hash::make($request->password),
            'category_id' => $request->category,
        ]);
        
        
        session(['otp' => $otp, 'user_id' => $user->id]);
            // Optionally, you can send the OTP via SMS or email here
            // $this->otpService->sendOtp($phone, $otp);

            // Redirect to OTP verification page
            return redirect()->route('otp.form',['phone' => $request->phone])->with([
                'success' => 'Registration successful! Please verify your mobile number using the OTP sent.',
                'phone' => $request->phone,
                'country_code' => $request->country_code,
            ]); // Pass phone number to the OTP form
        } else {
            return back()->withErrors(['otp' => 'Failed to send OTP. Please try again later.']);
        }
        //log the OTP sending status
        // if($otpsend) {
        //     \Log::info("OTP sent successfully to {$request->phone}",['data'=> $otpsend['return']]);
        // } else {
        //     \Log::error("Failed to send OTP to {$request->phone}");
        // }
        // Redirect to OTP verification page
        // return redirect()->route('otp.form')->with('success', 'Registration successful! Please verify your mobile number using the OTP sent.');
            
    }

    public function resendOtp(Request $request)
{
    \Log::info("Resend OTP function called");

    // Validate the phone number
    // $request->validate([
    //     'phone' => 'required|max:14',
    // ]);
    \Log::info("Phone number resend validated", ['phone' => $request->phone]);

    // Generate a new OTP
    $newOtp = rand(100000, 999999);

    // Send the OTP
    \Log::info("Sending OTP...");
    $otpsend = $this->otpService->sendOtp($request->phone, $newOtp);

    // Log the complete response from OTP service
    \Log::info("OTP resend service response", ['response' => $otpsend]);

    // Check if OTP was sent successfully
    if (!empty($otpsend['return']) && $otpsend['return'] === true) {
        session([
            'otp' => $newOtp,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'A new OTP has been sent to your registered mobile number.');
    } else {
        return back()->withErrors(['otp' => 'Failed to resend OTP. Please try again later.']);
    }
}

}
