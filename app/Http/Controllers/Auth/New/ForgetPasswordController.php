<?php
namespace App\Http\Controllers\Auth\New;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
class ForgetPasswordController extends Controller 
{
    public function showForgetPasswordForm()
    {
        return view('auth.new.forgot-password');
    }

    public function sendCodeToEmail(Request $request)
    {
        // dd($request->email);
        // Validate the email address
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => "We can't find a user with that email address."
        ]);
        
        //Generate a randdom code
        $code = rand(100000, 999999);

        // Store the code in the session or database (for demonstration, we'll use session)
        session(['forgot_password_verify_code_email' => $code]);

        // Send the code to the user's email address
        Mail::to($request->email)->send(new ResetPasswordMail($code));

        // Return a response indicating that the code has been sent
        return view('auth.new.verifycode', ['email' => $request->email])->with('success', 'Verification code sent to your email.');
        // return response()->json(['message' => 'Varification code sent to your email.'], 200);
    }
    public function verifyCode(Request $request)
    {
        // validate the code
        $request->validate([
            'code' => 'required',
            'email' => 'required|email|exists:users,email'
        ]);

        // Check if the code matches the one stored in the session
        if($request->code == session('forgot_password_verify_code_email'))
        {
            // Code is correct, redirect to the password reset form
            return view('auth.new.resetpassword', ['email' => $request->email])->with('success', 'Verification code is correct. You can now reset your password.');
        }
        else{
            return back()->withErrors(['code' => 'The verification code is incorrect.']);
        }
    }

    
    public function resetPassword(Request $request)
    {
        // $request->validate([
        //     'email'=>'required|email|exists:users,email',
        //     'password'=>'required|min:8|confirmed',
        //     'password_confirmation'=>'required|min:8'
        // ]);
        // Find the user by email
        if(strlen($request->password)== 0){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password field is required.']);
        }
        if(strlen($request->password_confirmation) == 0){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password confirmation field is required.']);
        }
        if(strlen($request->password)<8){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password must be at least 8 characters.']);
        }
        if(strlen($request->password_confirmation)< 8){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password confirmation must be at least 8 characters.']);
        }
        if($request->password != $request->password_confirmation){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password and confirmation password do not match.']);
        }
        if(strlen($request->password)< 8){
            return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['password' => 'The password must be at least 8 characters.']);
        }
     

       $user = User::where('email', $request->email)->first();
       if(!$user) {
           return view('auth.new.resetpassword', ['email' => $request->email])->withErrors(['email' => 'We can\'t find a user with that email address.']);
       }
       
       $user->password = Hash::make($request->password);
       $user->save();

       session()->forget('forget_passowrd_verify_code_email');
         return view('auth.login')->with('success', 'Password reset successfully. You can now log in with your new password.');
       
    }

}