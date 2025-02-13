<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        // Validate the login form fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user has completed the category-specific form
            if (!$user->form_filled) {
                // Redirect to form based on category
                switch ($user->category_id) {
                    case 1: // Investee
                        return redirect()->route('form.investee');
                    case 2: // Investor
                        return redirect()->route('form.investor');
                    case 3: // Banker
                        return redirect()->route('form.banker');
                    case 4: // Other
                        return redirect()->route('form.other');
                }
            }

            // Redirect to the category-specific dashboard if form is filled
            return $this->redirectToDashboard($user);
        }

        // If login attempt fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    /**
     * Redirect user based on their category after login.
     */
    protected function redirectToDashboard($user)
    {
        // Check the user's category and redirect accordingly
        switch ($user->category_id) {
            case 1: // Investee
                return redirect()->route('investee.dashboard');
            case 2: // Investor
                return redirect()->route('investor.dashboard');
            case 3: // Banker
                return redirect()->route('banker.dashboard');
            case 4: // Other
                return redirect()->route('other.dashboard');
            default:
                return redirect()->route('dashboard'); // General dashboard
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');  // Redirect to home after logout
    }
}
