<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message; // Import the Message model
use App\Http\Controllers\Controller; // Import the base Controller
use Illuminate\Support\Facades\Mail;
use App\Mail\NavbarMail; // Assuming you have a Mailable class for sending emails

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate form fields
         $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string',
        'message' => 'nullable|string',
    ]);

    //Send email
    // $send = Mail::to('investordekhopoojad@gmail.com')->send( new NavbarMail($request->all()));


    // Logic to handle the form submission, such as saving to the database or sending an email

    try {
        // Mail::to('investordekhopoojad@gmail.com')->send(new NavbarMail($request->all()));
        Mail::to('help@investordekho.in')->send(new NavbarMail($request->all()));
        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
    }

    }
}

