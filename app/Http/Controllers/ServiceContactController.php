<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceContact; // Assuming you want to save the data in a model
use Illuminate\Support\Facades\Mail;

class ServiceContactController extends Controller
{
    public function showContactForm()
    {
        return view('service_contact_form'); // Return the view for the contact form
    }

   public function submitContactForm(Request $request)
{
    // Validate form fields
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|digits:10',
        'services' => 'required|array',
        'services.*' => 'string',
        'note' => 'nullable|string',
    ]);

    // Logic to handle the form submission, such as saving to the database or sending an email

    return redirect()->back()->with('success', 'Your request has been submitted successfully.');
}

}
