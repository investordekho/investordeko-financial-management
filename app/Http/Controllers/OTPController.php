<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line

class OTPController extends Controller
{
    use ValidatesRequests; // Include this trait to enable validation
    
    public function showOtpForm()
    {
        return view('auth.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        // Use validate() method for OTP validation
        $this->validate($request, [
            'otp' => 'required|string',
        ]);

        // Default OTP for testing
        $otp = '123456';

        // Check if the entered OTP matches
        if ($request->otp == $otp) {
            // Optionally, clear the OTP from the session or mark user as verified
            session()->forget('otp'); // This line can be kept if using sessions
            
            // Redirect to login with success message
            return redirect()->route('login')->with('success', 'Your mobile number has been verified. Please log in.');
        } else {
            // Return an error if the OTP doesn't match
            return back()->withErrors(['otp' => 'The entered OTP is incorrect. Please try again.']);
        }
    }
}



