<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\ContactDetails;
use App\Models\PublicLink;
use App\Models\InvestmentDetails; // Import the InvestmentDetails model


class FormController extends Controller
{
    // Show Investee Form
    public function showInvesteeForm()
    {
        return view('forms.investee_form'); // Ensure this view file exists
    }

    // Show Investor Form
    public function showInvestorForm()
    {
        return view('forms.investor_form'); // Ensure this view file exists
    }

    // Show Banker Form
    public function showBankerForm()
    {
        return view('forms.banker_form'); // Ensure this view file exists
    }

    // Show Other Form
    public function showOtherForm()
    {
        return view('forms.other_form'); // Ensure this view file exists
    }

    // Submit Investee Form Handler
   // Submit Investee Form Handler
public function submitInvesteeForm(Request $request)
{
    $validatedData = $request->validate([
       'company_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'nature_of_business' => 'required|string|max:255',
        'incorporated_in' => 'required|numeric',
        'concerned_person_name' => 'required|string|max:255',
        'concerned_person_designation' => 'required|string|max:255',
        'concerned_person_email' => 'required|email|max:255',
        'concerned_person_phone' => 'required|numeric|digits:10',
        'company_website' => 'required|url',
        'linkedin' => 'required|url',
        'public_links.*' => 'nullable|url',
        'link_descriptions.*' => 'nullable|string',
        'founder_name.*' => 'required|string|max:255',
        'founder_position.*' => 'required|string',
        'founder_education.*' => 'required|string|max:255',
        'founder_experience.*' => 'required|numeric',
        'fund_usage.*' => 'required|string',
        'fund_requirement.*' => 'required|numeric',
        'fund_unit.*' => 'required|string',
        'previous_rounds.*' => 'required|string',
        'investors.*' => 'required|string|max:255',
        'amount_raised.*' => 'required|numeric',
        'valuation.*' => 'required|numeric',
        'fiscal_year.*' => 'required|string',
        'financials.*' => 'nullable|file|mimes:pdf,doc,docx',
        'pitch_deck' => 'required|file|mimes:pdf,doc,docx',
        'referral_source' => 'required|string',
        'terms' => 'accepted',
    ]);

    // Store data in the database (Investee)
    $investee = new Investee();
    $investee->company_name = $request->company_name;
    $investee->address = $request->address;
    $investee->nature_of_business = $request->nature_of_business;
    $investee->incorporated_in = $request->incorporated_in;
    $investee->save();

    return redirect()->route('dashboard')->with('success', 'Investee form submitted successfully!');
}

 public function submitInvestorForm(Request $request)
    {
        // Step 1: Validate form input
        $validatedData = $request->validate([
            'investor_name' => 'required|string',
            'sectors_preferred' => 'required|array',
            'sectors_preferred.*' => 'string',
            'address' => 'required|string',
            'investor_profile' => 'nullable|file|mimes:jpg,png,pdf', // Optional file upload
            'concerned_person_name' => 'required|string',
            'concerned_person_designation' => 'required|string',
            'concerned_person_phone' => 'required|string|max:10',
            'email' => 'required|email',
            'public_links' => 'array',
            'public_links.*' => 'url',
            'invest_in' => 'required|string',
            'investor_type' => 'required|string',
            'investment_size' => 'required|string',
            'investment_tenure' => 'required|string',
            'previous_investment_year' => 'array',
            'previous_investment_company' => 'array',
            'previous_investment_company.*' => 'string',
            'sector' => 'array',
            'sector.*' => 'string',
        ]);

        // Step 2: Store form data in the Investor table
        $investor = new Investor();
        $investor->investor_name = $request->investor_name;
        $investor->sectors_preferred = implode(',', $request->sectors_preferred);
        $investor->address = $request->address;
        $investor->user_id = auth()->id(); // Assuming the user is logged in

        // Handle investor profile file upload if provided
        if ($request->hasFile('investor_profile')) {
            $investor->investor_profile = $request->file('investor_profile')->store('investor_profiles');
        }

        $investor->save();

        // Step 3: Store data in the Contact Details table
        $contactDetails = new ContactDetails();
        $contactDetails->investors_id = $investor->id;
        $contactDetails->concerned_person_name = $request->concerned_person_name;
        $contactDetails->concerned_person_designation = $request->concerned_person_designation;
        $contactDetails->concerned_person_phone = $request->concerned_person_phone;
        $contactDetails->email = $request->email;
        $contactDetails->save();

        // Step 4: Store data in the Investment Details table
        $investmentDetails = new InvestmentDetails();
        $investmentDetails->investor_id = $investor->id;
        $investmentDetails->invest_in = $request->invest_in;
        $investmentDetails->investor_type = $request->investor_type;
        $investmentDetails->investment_size = $request->investment_size;
        $investmentDetails->investment_tenure = $request->investment_tenure;
        $investmentDetails->save();

        // Step 5: Handle public links (optional section)
            if ($request->has('public_links')) {
                foreach ($request->public_links as $index => $link) {
                    $investor->publicLinks()->create([
                        'url' => $link,
                        'description' => $request->link_descriptions[$index], // Make sure this is filled
                    ]);
                }
            }


       // Step 6: Handle previous investments (optional section)
if ($request->has('previous_investment_year')) {
    foreach ($request->previous_investment_year as $index => $year) {
        // Assuming you have a relationship defined in the Investor model for previous investments
        $investor->previousInvestments()->create([
            'previous_investment_year' => $year,
            'previous_investment_company' => $request->previous_investment_company[$index],
            'sector' => $request->sector[$index],
            'investors_id' => $investor->id, // Assuming 'investors_id' is the foreign key in the previous_investments table
        ]);
    }
}

        // Step 7: Redirect after form submission
$user = auth()->user();
$user->form_filled = 1; // Mark the form as filled
$user->save(); // Save the changes to the database

        // Step 8: Redirect after form submission
return redirect()->route('investor.dashboard')->with('success', 'Investor form submitted successfully!');

    }


// Submit Banker Form Handler
public function submitBankerForm(Request $request)
{
    $validatedData = $request->validate([
        'bank_name' => 'required|string',
        'branch' => 'required|string',
        'ifsc_code' => 'required|string',
        // Add other validation rules for Banker form
    ]);

    // Store data in the database (Banker)
    $banker = new Banker();
    $banker->bank_name = $request->bank_name;
    $banker->branch = $request->branch;
    $banker->ifsc_code = $request->ifsc_code;
    $banker->save();

    return redirect()->route('dashboard')->with('success', 'Banker form submitted successfully!');
}

// Submit Other Form Handler
public function submitOtherForm(Request $request)
{
    $validatedData = $request->validate([
        'entity_name' => 'required|string',
        'description' => 'required|string',
        // Add other validation rules for Other form
    ]);

    // Store data in the database (Other)
    $other = new Other();
    $other->entity_name = $request->entity_name;
    $other->description = $request->description;
    $other->save();

    return redirect()->route('dashboard')->with('success', 'Other form submitted successfully!');
}

}
