<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Fetch categories for the registration form
        $categories = Category::all();
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['num1' => $num1, 'num2' => $num2]);

        return view('auth.register', compact('categories'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'category' => 'required',
            'captcha' => 'required|in:' . session('captcha'),
            'terms' => 'accepted',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'category_id' => $request->category,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
