<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceContact; // Assuming you want to save the data in a model
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceMail; // Assuming you have a Mailable class for sending emails
class ServiceContactController extends Controller
{
    public function showContactForm()
    {
        return view('service_contact_form'); // Return the view for the contact form
    }

public function submitContactForm(Request $request)
{
    // STEP 1: Log incoming request
    \Log::info('Service Contact Form submitted.', ['input' => $request->all()]);

    // STEP 2: Validate input and log errors if any
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'services' => 'required|array',
            'services.*' => 'string',
            'note' => 'nullable|string',
        ]);
        \Log::info('Validation passed.', ['validated' => $validated]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed.', [
            'errors' => $e->errors(),
            'input' => $request->all()
        ]);
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
    }

    // STEP 3: Attempt to send email
    try {
        \Log::info('Attempting to send service mail.');
        Mail::to('investordekhopoojad@gmail.com')->send(new ServiceMail($request->all()));
        \Log::info('Service mail sent successfully.');
        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    } catch (\Exception $e) {
        \Log::error('Error sending mail.', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('error', 'There was an error submitting your request. Please try again.');
    }
}

}
