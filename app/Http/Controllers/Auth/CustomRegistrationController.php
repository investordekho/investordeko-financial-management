<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CustomRegistrationController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        // Fetch categories from the database
        $categories = Category::all();

        // Generate random numbers for CAPTCHA
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);

        // Store the CAPTCHA values in session
        session(['captcha_value_1' => $num1, 'captcha_value_2' => $num2]);

        // Pass the categories and CAPTCHA values to the view
        return view('auth.register', compact('categories', 'num1', 'num2'));
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        // Validate the request data, including the CAPTCHA
        $this->validator($request->all())->validate();

        // Check if the CAPTCHA is correct
        if ($request->captcha != (session('captcha_value_1') + session('captcha_value_2'))) {
            return back()->withErrors(['captcha' => 'The CAPTCHA is incorrect.'])->withInput();
        }

        // Create the user
        $user = $this->create($request->all());

        // Log the user in after registration
        Auth::login($user);

        // Redirect to OTP verification form
        return redirect()->route('otp.form');
    }

    /**
     * Validate the registration form data.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'min:10', 'max:10'],
            'category' => ['required', 'integer', 'exists:categories,id'],
            'captcha' => ['required', 'integer'], // CAPTCHA validation rule
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'category_id' => $data['category'],
        ]);
    }
}
