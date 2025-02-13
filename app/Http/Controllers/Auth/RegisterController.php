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

class RegisterController extends Controller
{
    // Add the ValidatesRequests trait to your controller
    use ValidatesRequests;

    public function showRegistrationForm()
    {
        // Generate captcha numbers and store in session
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['captcha_value_1' => $num1, 'captcha_value_2' => $num2]);

        // Fetch categories for the registration form
        $categories = Category::all();

        return view('auth.register', compact('categories', 'num1', 'num2'));
    }

    public function register(Request $request)
{
    // Validate the form fields
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:10|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'category' => 'required',
        'captcha' => 'required',
        'terms' => 'accepted',
    ]);

    // Manually validate captcha
    $num1 = session('captcha_value_1');
    $num2 = session('captcha_value_2');
    $correctCaptcha = $num1 + $num2;

    if ($request->captcha != $correctCaptcha) {
        return back()->withErrors(['captcha' => 'The entered captcha is incorrect'])->withInput();
    }

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'category_id' => $request->category,
    ]);

    // Store OTP (default 123456) in session
    session(['otp' => '123456', 'user_id' => $user->id]);

    // Redirect to OTP verification page
    return redirect()->route('otp.form')->with('success', 'Registration successful! Please verify your mobile number using the OTP sent.');
}
}
