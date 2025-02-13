<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVerifiedUser
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and verified
        if (Auth::check() && !Auth::user()->is_verified) {
            return redirect()->route('otp.form')->with('error', 'You need to verify your phone number.');
        }

        return $next($request);
    }

    
}
