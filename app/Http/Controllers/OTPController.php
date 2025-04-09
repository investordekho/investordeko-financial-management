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

    // Send OTP
    // public function send(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required|digits:10',
    //     ]);

    //     $otp = rand(100000, 999999); // generate 6-digit OTP

    //     // Store OTP and phone in session (or DB if needed)
    //     session(['otp' => $otp, 'phone' => $request->phone]);
        
    //     $response = $this->otpService->sendOtp($request->phone, $otp);
    //     dd($response); // <-- Add this temporarily
    //     return response()->json([
    //         'message' => 'OTP sent successfully!',
    //         'otp' => $otp, // only for testing; remove in production
    //         'api_response' => $response
    //     ]);
    // }

    // Verify OTP
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
}

