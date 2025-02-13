<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Other;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    /**
     * Handle the submission of the "Other" form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submitOtherForm(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:10',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'referral_source' => 'required|string|max:255',
            'terms' => 'required|accepted', // Terms must be accepted
        ]);

        // Create a new "Other" entry in the database
        Other::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'referral_source' => $request->input('referral_source'),
            'agreed_to_terms' => $request->has('terms') ? 1 : 0,  // Checkbox for terms agreement
        ]);

        // Mark the user's form as filled in the users table
        $user = Auth::user();
        $user->form_filled = true; // Assuming this column exists
        $user->save();

        // Redirect with success message
        return redirect()->route('other.dashboard')->with('success', 'Form submitted successfully.');
    }

    // Show the form for "Other" users
    public function showOtherForm()
    {
        return redirect()->route('banker.dashboard')->with('success', 'Form submitted successfully.');
}
    }

