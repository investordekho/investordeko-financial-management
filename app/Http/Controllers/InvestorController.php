<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\ContactDetail;
use App\Models\PublicLink;
use App\Models\InvestmentDetail;
use App\Models\PreviousInvestment;
use App\Models\Referral;
use App\Models\GuidanceNeed;
use Illuminate\Support\Facades\Auth;

class InvestorController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'investor_name' => 'required|string|max:255',
            'sectors_preferred' => 'required|array', // Make sure this is an array
            'Address' => 'required|string',
            'concerned_person_name' => 'required|string',
            'concerned_person_designation' => 'required|string',
            'concerned_person_phone' => 'required|string|max:10',
            'email' => 'required|email',
            'public_links.*' => 'required|url',
            'link_descriptions.*' => 'required|string',
            'invest_in' => 'required|string',
            'investor_type' => 'required|string',
            'investment_size' => 'required|string',
            'investment_tenure' => 'required|string',
            'previous_investment_year.*' => 'required|integer',
            'previous_investment_company.*' => 'required|string',
            'sector.*' => 'required|string',
            'referral_source' => 'required|string',
            'guidance_needed' => 'required|array',
            'investor_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Handle file upload for investor profile
        $filePath = null;  // Initialize as null
        if ($request->hasFile('investor_profile')) {
            // Store the file and get the path
            $filePath = $request->file('investor_profile')->store('investor_profiles', 'public');
        }

        // Convert the sectors array to a comma-separated string
        $sectors_preferred = implode(',', $request->input('sectors_preferred'));  // Convert array to string

        // Store the investor profile
        $investor = Investor::create([
            'user_id' => Auth::id(),  // Authenticated user's ID
            'investor_name' => $request->investor_name,
            'address' => $request->address,
            'investor_profile' => $filePath,  // Use the uploaded file path
            'sectors_preferred' => $sectors_preferred,  // Save as comma-separated string
        ]);

        // Store contact details
        ContactDetail::create([
            'investor_id' => $investor->id,
            'concerned_person_name' => $request->concerned_person_name,
            'concerned_person_designation' => $request->concerned_person_designation,
            'concerned_person_phone' => $request->concerned_person_phone,
            'email' => $request->email,
        ]);

        // Store public links
        if ($request->has('public_links')) {
            foreach ($request->public_links as $index => $url) {
                PublicLink::create([
                    'investor_id' => $investor->id,
                    'url' => $url,
                    'link_description' => $request->link_descriptions[$index],
                ]);
            }
        }

        // Store investment details
        InvestmentDetail::create([
            'investor_id' => $investor->id,
            'invest_in' => $request->invest_in,
            'investor_type' => $request->investor_type,
            'investment_size' => $request->investment_size,
            'investment_tenure' => $request->investment_tenure,
        ]);

        // Store previous investments
        if ($request->has('previous_investment_year')) {
            foreach ($request->previous_investment_year as $index => $year) {
                PreviousInvestment::create([
                    'investor_id' => $investor->id,
                    'previous_investment_year' => $year,
                    'previous_investment_company' => $request->previous_investment_company[$index],
                    'sector' => $request->sector[$index],
                ]);
            }
        }

        // Store referral
        Referral::create([
            'investor_id' => $investor->id,
            'referral_source' => $request->referral_source,
        ]);

        if ($request->has('guidance_needed')) {
            foreach ($request->guidance_needed as $guidance) {
                GuidanceNeed::create([
                    'investor_id' => $investor->id,
                    'guidance_needed' => is_array($guidance) ? implode(',', $guidance) : $guidance,  // Convert array to comma-separated string if needed
                    'other_guidance' => $request->other_guidance ?? null,
                ]);
            }
        }
        

        // Update the user's profile to indicate the form has been filled
        $user = Auth::user();
        $user->form_filled = true; // Assuming this column exists in your users table
        $user->save();

        // Redirect the user to the investor dashboard with a success message
        return redirect()->route('investor.dashboard')->with('success_message', 'Investor profile created successfully!');
    }
}
