<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Services\OtpService;
class OTPController extends Controller
{
    use ValidatesRequests; // Include this trait to enable validation
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function showForm()
    {
        return view('auth.verify_otp');
    }


    
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if ($request->otp == session('otp')) {

            session()->forget('otp'); // Clear OTP from session
           
            // You can mark user as verified or logged in
            // return response()->json(['message' => 'OTP verified successfully!']);
            return redirect()->route('login')->with('success', 'Your mobile number has been verified. Please log in.');
        }

        // return response()->json(['message' => 'Invalid OTP'], 422);
        return back()->withErrors(['otp'=> 'The entered OTP is incorrect. Please try again.']);
    }
    // public function verify(Request $request)
    // {
    //     $request->validate([
    //         'otp' => 'required|digits:6',
    //     ]);

    //     if ($request->otp == '123456') { // Replace with actual OTP verification logic

    //         // session()->forget('otp'); // Clear OTP from session
           
    //         // You can mark user as verified or logged in
    //         // return response()->json(['message' => 'OTP verified successfully!']);
    //         return redirect()->route('login')->with('success', 'Your mobile number has been verified. Please log in.');
    //     }

    //     // return response()->json(['message' => 'Invalid OTP'], 422);
    //     return back()->withErrors(['otp'=> 'The entered OTP is incorrect. Please try again.']);
    // }
}

