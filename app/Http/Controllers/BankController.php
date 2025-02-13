<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banker; // Import the Bank model
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function submitBankForm(Request $request)
    {
        // Validation for the form
        $request->validate([
            'company_name' => 'required|string|max:255',
            'incorporated_in' => 'required|integer',
            'ib_team_size' => 'required|string',
            'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:10',
            'concerned_person_designation' => 'required|string',
            'public_links.*' => 'required|url',
            'link_descriptions.*' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'min_fund_raise_size' => 'required|string',
            'max_fund_raise_size' => 'required|string',
            'previous_deal_year.*' => 'required|integer',
            'previous_deal_company.*' => 'required|string',
            'previous_deal_sector.*' => 'required|string',
            'previous_deal_type.*' => 'required|string',
            'referral_source' => 'required|string',
        ]);

        // Handle the company profile file upload
        $filePath = null;
        if ($request->hasFile('company_profile')) {
            $filePath = $request->file('company_profile')->store('company_profiles', 'public');
        }

        // Save bank form data to database
        $bank = Banker::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'incorporated_in' => $request->incorporated_in,
            'ib_team_size' => $request->ib_team_size,
            'company_profile' => $filePath,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'concerned_person_designation' => $request->concerned_person_designation,
            'address' => $request->address,
            'location' => $request->location,
            'state' => $request->state,
            'country' => $request->country,
            'min_fund_raise_size' => $request->min_fund_raise_size,
            'max_fund_raise_size' => $request->max_fund_raise_size,
            'referral_source' => $request->referral_source,
        ]);

        // Save public links
        if ($request->has('Banker_public_links')) {
            foreach ($request->public_links as $index => $url) {
                BankerPublicLink::create([
                    'banker_id' => $banker->id,
                    'url' => $url,
                    'link_description' => $request->link_descriptions[$index],
                ]);
            }
        }

        // Save previous deals
        if ($request->has('Banker_previous_deal')) {
            foreach ($request->previous_deal as $index => $year) {
                BankerPreviousDeal::create([
                    'bank_id' => $bank->id,
                    'previous_deal_year' => $year,
                    'previous_deal_company' => $request->previous_deal_company[$index],
                    'previous_deal_sector' => $request->previous_deal_sector[$index],
                    'previous_deal_type' => $request->previous_deal_type[$index],
                ]);
            }
        }

        $user = Auth::user();
        $user->form_filled = true; // Assuming this column exists in your users table
        $user->save();

        // Redirect to dashboard
        return redirect()->route('banker.dashboard')->with('success_message', 'Banker profile created successfully!');
    }
}
