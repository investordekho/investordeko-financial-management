<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\ContactDetails;
use App\Models\PublicLink;
use App\Models\InvestmentDetails; // Import the InvestmentDetails model
use App\Models\Referral;
use App\Models\Company;
use App\Models\ConcernedPerson;
use App\Models\Founder;
use App\Models\FundRequirement;
use App\Models\PreviousRound;
use App\Models\Attachment;
use App\Models\OtherLink;
use App\Models\ReferralSource;
use App\Models\GuidanceNeeded;
use App\Models\Banker;
use App\Models\Other;
use App\Models\TermsAcceptance;
use App\Models\Financial;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Investee;
use App\Models\InvestorProfile;
use App\Models\BankerProfile;
use App\Models\OtherProfile;
use App\Models\InvesteeProfile;


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
        'concerned_person_phone' => 'required',
        'company_website' => 'required|url',
        'linkedin' => 'required|url',
        // 'public_links.*' => 'nullable|url',
        'link_descriptions.*' => 'nullable|string',
        'founder_name.*' => 'required|string|max:255',
        'founder_position.*' => 'required|string',
        'founder_education.*' => 'required|string|max:255',
        'founder_experience.*' => 'required|numeric',
        'fund_usage.*' => 'nullable|string',
        'fund_requirement.*' => 'required|numeric',
        'fund_unit.*' => 'required|string',
        'previous_rounds.*' => 'required|string',
        'investors.*' => 'required|string|max:255',
        'amount_raised.*' => 'required|numeric',
        'valuation.*' => 'required|numeric',
        'fiscal_year.*' => 'required|string',
        'financials.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
        'pitch_deck' => 'required|file|mimes:ppt,pptx,pdf,doc,docx',
        'other_attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        'referral_source' => 'required|string',
        'guidance_needed.*' => 'nullable|string',
        'other_links.*' => 'nullable|url',
        'link_descriptions.*' => 'nullable|string',
        'terms' => 'accepted'
        // 'terms' => 'accepted',
    ]);

    // Store data in the database (Investee)
    $investee = new Company();
    $investee->company_name = $request->company_name;
    $investee->address = $request->address;
    $investee->nature_of_business = $request->nature_of_business;
    $investee->incorporated_in = $request->incorporated_in;
    $investee->website = $request->company_website;
    $investee->linkedin = $request->linkedin;
    $investee->save();

    // Store concerned person details = 
    $concernedPerson = new ConcernedPerson();
    $concernedPerson->company_id = $investee->id;
    $concernedPerson->name = $request->concerned_person_name;
    $concernedPerson->designation = $request->concerned_person_designation;
    $concernedPerson->email = $request->concerned_person_email;
    $concernedPerson->phone = $request->concerned_person_phone;
    $concernedPerson->save();
    // Store public links
    
    // if ($request->has('public_links')) {
    //     foreach ($request->public_links as $index => $link) {
    //         $publicLink = new PublicLink();
    //         $publicLink->investee_id = $investee->id;
    //         $publicLink->url = $link;
    //         $publicLink->link_description = $request->link_descriptions[$index];
    //         $publicLink->save();
    //     }
    // }
    // Store founder details =

    if ($request->has('founder_name')) {
        foreach ($request->founder_name as $index => $name) {
            $founder = new Founder();
            $founder->company_id = $investee->id;
            $founder->name = $name;
            $founder->position = $request->founder_position[$index];
            $founder->education = $request->founder_education[$index];
            $founder->experience = $request->founder_experience[$index];
            $founder->save();
        }
    }

    // Store fund requirements =
    if ($request->has('fund_usage')) {
        foreach ($request->fund_usage as $index => $usage) {
            $fundRequirement = new FundRequirement();
            $fundRequirement->company_id = $investee->id;
            $fundRequirement->usage = $usage;
            $fundRequirement->amount = $request->fund_requirement[$index];
            $fundRequirement->unit = $request->fund_unit[$index];
            $fundRequirement->save();
        }
    }
    // Store previous rounds=
    if ($request->has('previous_rounds')) {
        foreach ($request->previous_rounds as $index => $round) {
            $previousRound = new PreviousRound();
            $previousRound->investee_id = $investee->id;
            $previousRound->round = $investee->previous_rounds[$index];
            $previousRound->investor = $request->investors[$index];
            $previousRound->amount_raised = $request->amount_raised[$index];
            $previousRound->valuation = $request->valuation[$index];
            $previousRound->save();
        }
    }

    // Store financials
    // if ($request->has('financials')) {
    //     foreach ($request->financials as $index => $file) {
    //         $financial = new Financial();
    //         $financial->investee_id = $investee->id;
    //         $financial->fiscal_year = $request->fiscal_year[$index];
    //         $financial->file_path = $file->store('financials');
    //         $financial->save();
    //     }
    // }============

    if($request->has('other_links')) {
        foreach ($request->other_links as $index => $link) {
            $otherLink = new OtherLink();
            $otherLink->company_id = $investee->id;
            $otherLink->link_url = $link;
            $otherLink->link_description = $request->link_descriptions[$index];
            $otherLink->save();
        }
    }

     // Store attachments = ======================= 
     if ($request->hasFile('financials')) {
        foreach ($request->file('financials') as $file) {
            $attachment = new Attachment();
            $attachment->investee_id = $investee->id;
            $attachment->type ="financials"; // Assuming you want to store the file type    
            $attachment->fiscal_year = $request->fiscal_year; // Assuming you have a fiscal year field in the form            
            $attachment->file_path = $file->store('financials');
            $attachment->save();
        }
    }

    // Store pitch deck ==========================
    if ($request->hasFile('pitch_deck')) {
        $pitchDeck = new Attachment();
        $pitchDeck->investee_id = $investee->id;
        $pitchDeck->type = 'pitch_deck'; // Assuming you want to store the file type
        $pitchDeck->fiscal_year = date('Y'); // Assuming you have a fiscal year field in the form
        $pitchDeck->file_path = $request->file('pitch_deck')->store('pitch_decks');
        $pitchDeck->save();
    }

    // Store other attachments ==========================
    if ($request->hasFile('other_attachment')) {
        $otherAttachment = new Attachment();
        $otherAttachment->investee_id = $investee->id;
        $otherAttachment->type = 'other'; // Assuming you want to store the file type
        $otherAttachment->fiscal_year = date('Y'); // Assuming you have a fiscal year field in the form
        $otherAttachment->file_path = $request->file('other_attachment')->store('other_attachments');
        $otherAttachment->save();
    }
    // Store referral source =======================
    $referralSource = new ReferralSource();
    $referralSource->investee_id = $investee->id;
    $referralSource->source = $request->referral_source;
    $referralSource->save();
    // Store terms acceptance
    // $termsAcceptance = new TermsAcceptance();
    // $termsAcceptance->investee_id = $investee->id;
    // $termsAcceptance->accepted = $request->terms;
    // $termsAcceptance->save();
   
    // Store guidance needed================================
    if ($request->has('guidance_needed')) {
        foreach ($request->guidance_needed as $index => $guidance) {
            $guidanceNeeded = new GuidanceNeeded();
            $guidanceNeeded->investee_id = $investee->id;
            $guidanceNeeded->guidance_needed = $guidance;
            $guidanceNeeded->save();
        }
    }
    // Step 7: Redirect after form submission
    $user = auth()->user();
    $user->form_filled = 1; // Mark the form as filled
    $user->save(); // Save the changes to the database
    // Step 8: Redirect after form submission

    return redirect()->route('dashboard')->with('success', 'Investee form submitted successfully!');
}

 public function submitInvestorForm(Request $request)
    {
        // Step 1: Validate form input
        $validatedData = $request->validate([
            'investor_name' => 'required|string',
            'sectors_preferred' => 'required|array|min:1',
            'sectors_preferred.*' => 'string',
            'address' => 'required|string',
            'investor_profile' => 'required|file', // Optional file upload
            'concerned_person_name' => 'required|string',
            'concerned_person_designation' => 'required|string',
            'concerned_person_phone' => 'required',
            'email' => 'required|email',
            'public_links' => 'array',
            'public_links.*' => 'url',
            'link_descriptions' => 'array',
            'link_descriptions.*' => 'nullable|string',
            'invest_in' => 'required|string',
            'investor_type' => 'required|string',
            'investment_size' => 'required|string',
            'investment_tenure' => 'required|string',
            'previous_investment_year' => 'required|array|min:1',
            'previous_investment_year.*' => 'required|integer|min:2000|max:' . date('Y'),
            'previous_investment_company' => 'array',
            'previous_investment_company.*' => 'string',
            'sector' => 'required|array|min:1',
            'sector.*' => 'required|string',
            'referral_source' => 'required|string',
            'terms' => 'accepted'
        ]);

        // Step 2: Store form data in the Investor table
        $investor = new Investor();
        $investor->investor_name = $request->investor_name;
        $investor->sectors_preferred = implode(',', $request->sectors_preferred);
        $investor->address = $request->address;
        $investor->user_id = auth()->id(); // Assuming the user is logged in

        // // Handle investor profile file upload if provided
        // if ($request->hasFile('investor_profile')) {
        //     // $investor->investor_profile = $request->file('investor_profile')->store('investor_profiles');
        //     $investor->investor_profile = $request->file('investor_profile')->store('investor_profiles', 'public');
        // }

        if ($request->hasFile('investor_profile')) {
            $file = $request->file('investor_profile');

            // Optional: delete old file if updating
            // if ($investor->investor_profile && Storage::disk('public')->exists('investor_profiles/' . $investor->investor_profile)) {
            //     Storage::disk('public')->delete('investor_profiles/' . $investor->investor_profile);
            // }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('investor_profiles', $filename, 'public');
            $investor->investor_profile = $filename; // Save only filename
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
                        'link_description' => $request->link_descriptions[$index], // Make sure this is filled
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

        if($request->has('referral_source')) {
            $referralSource = new Referral();
            $referralSource->investor_id = $investor->id;
            $referralSource->referral_source = $request->referral_source;
            $referralSource->save();
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

public function updateprofileview()
{
    $userId = auth()->id();
    $investor = Investor::where('user_id', $userId)->firstOrFail();
    $contactDetails = $investor->contactDetails()->first();
    $investmentDetails = $investor->investmentDetails()->first();
    $publicLinks = $investor->publicLinks()->get();
    $previousInvestments = $investor->previousInvestments()->get();
    $referral = $investor->referrals()->first();
    $guidanceNeeds = $investor->guidanceNeeds()->first();
    $investorAddresses = $investor->investorAddresses()->get();
    // $locationDetail = $investor->locationDetail()->first();

    $company = Company::where('user_id', $userId)->firstOrFail();
    $concernedPerson = $company->concernedPerson()->first();
    $founders = $company->founders()->get();
    $fundRequirements = $company->fundRequirements()->get();
    $previousRounds = $company->previousRounds()->get();
    $attachments = $company->attachments()->get(); 
    $otherLinks = $company->otherLinks()->get();
    $attachments = $company->attachments()->get();
    $referralSource = $company->referralSource()->first();
    $guidanceNeeded = $company->guidanceNeeded()->get();
    
    $pitchDeck = $company->attachments()->where('type', 'pitch_deck')->first();
    $financials = $company->attachments()->where('type', 'financials')->get();
    $otherAttachments = $company->attachments()->where('type', 'other')->get(); 


    // $categoryid = Auth::user()->category_id;
    $categoryid = auth()->user()->category_id;  
    if($categoryid == 1) {
        return view('updateforms.investee_form', compact(
            'company', 'concernedPerson', 'founders', 'fundRequirements', 
            'previousRounds', 'attachments','pitchDeck','financials','otherAttachments', 'otherLinks', 'referralSource', 
            'guidanceNeeded'
        ));
    } elseif ($categoryid == 2) {
        return view('updateforms.investor_form', compact(
            'investor', 'contactDetails', 'investmentDetails', 
            'publicLinks', 'previousInvestments', 'referral', 
            'guidanceNeeds', 'investorAddresses'
        ));
    } elseif ($categoryid == 3) {
        return view('updateforms.banker_form');
    } elseif ($categoryid == 4) {
        return view('updateforms.other_form');
    }
    return redirect()->route('dashboard')->with('error', 'Invalid category ID.');
}
public function updateInvestorForm(Request $request)
{
    $validatedData = $request->validate([
        'investor_name' => 'required|string',
        'sectors_preferred' => 'required|array|min:1',
        'sectors_preferred.*' => 'string',
        'address' => 'required|string',
        'investor_profile' => 'nullable|file',
        'concerned_person_name' => 'required|string',
        'concerned_person_designation' => 'required|string',
        'concerned_person_phone' => 'required',
        'email' => 'required|email',
        'public_links' => 'array',
        'public_links.*' => 'url',
        'link_descriptions' => 'array',
        'link_descriptions.*' => 'nullable|string',
        'invest_in' => 'required|string',
        'investor_type' => 'required|string',
        'investment_size' => 'required|string',
        'investment_tenure' => 'required|string',
        'previous_investment_year' => 'required|array|min:1',
        'previous_investment_year.*' => 'required|integer|min:2000|max:' . date('Y'),
        'previous_investment_company' => 'array',
        'previous_investment_company.*' => 'nullable|string',
        'sector' => 'required|array|min:1',
        'sector.*' => 'required|string',
        'referral_source' => 'required|string',
        'terms' => 'accepted'
    ]);

    $userId = auth()->id();

    $investor = Investor::where('user_id', $userId)->firstOrFail();

    $investor->investor_name = $request->investor_name;
    $investor->sectors_preferred = implode(',', $request->sectors_preferred);
    $investor->address = $request->address;

    // if ($request->hasFile('investor_profile')) {
    //     $investor->investor_profile = $request->file('investor_profile')->store('investor_profiles');
    // }

      if ($request->hasFile('investor_profile')) {
            $file = $request->file('investor_profile');

            // Optional: delete old file if updating
            // if ($investor->investor_profile && Storage::disk('public')->exists('investor_profiles/' . $investor->investor_profile)) {
            //     Storage::disk('public')->delete('investor_profiles/' . $investor->investor_profile);
            // }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('investor_profiles', $filename, 'public');
            $investor->investor_profile = $filename; // Save only filename
        }

    $investor->save();

    // Update or create contact details
    $investor->contactDetails()->updateOrCreate(
        [],
        [
            'concerned_person_name' => $request->concerned_person_name,
            'concerned_person_designation' => $request->concerned_person_designation,
            'concerned_person_phone' => $request->concerned_person_phone,
            'email' => $request->email
        ]
    );

    // Update or create investment details
    $investor->investmentDetails()->updateOrCreate(
        [],
        [
            'invest_in' => $request->invest_in,
            'investor_type' => $request->investor_type,
            'investment_size' => $request->investment_size,
            'investment_tenure' => $request->investment_tenure
        ]
    );

    // Delete and re-create public links
    $investor->publicLinks()->delete();
    if ($request->has('public_links')) {
        foreach ($request->public_links as $index => $link) {
            $investor->publicLinks()->create([
                'url' => $link,
                'link_description' => $request->link_descriptions[$index] ?? null
            ]);
        }
    }

    // Delete and re-create previous investments
    $investor->previousInvestments()->delete();
    foreach ($request->previous_investment_year as $index => $year) {
        $investor->previousInvestments()->create([
            'previous_investment_year' => $year,
            'previous_investment_company' => $request->previous_investment_company[$index] ?? null,
            'sector' => $request->sector[$index],
            'investors_id' => $investor->id,
        ]);
    }

    // Update or create referral
    $investor->referrals()->delete(); // Assuming only one referral per investor
    $investor->referrals()->create([
        'referral_source' => $request->referral_source,
    ]);

    // Mark the user as having completed the form
    $user = auth()->user();
    $user->form_filled = 1;
    $user->save();

    return redirect()->route('investor.dashboard')->with('success', 'Investor form updated successfully!');
}

public function updateInvesteeForm(Request $request)
{
    $validatedData = $request->validate([
        'company_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'nature_of_business' => 'required|string|max:255',
        'incorporated_in' => 'required|numeric',
        'concerned_person_name' => 'required|string|max:255',
        'concerned_person_designation' => 'required|string|max:255',
        'concerned_person_email' => 'required|email|max:255',
        'concerned_person_phone' => 'required',
        'company_website' => 'required|url',
        'linkedin' => 'required|url',
        // Add other validation rules as needed
    ]);

    $userId = auth()->id();
    $company = Company::where('user_id', $userId)->firstOrFail();

    $company->company_name = $request->company_name;
    $company->address = $request->address;
    $company->nature_of_business = $request->nature_of_business;
    $company->incorporated_in = $request->incorporated_in;
    $company->website = $request->company_website;
    $company->linkedin = $request->linkedin;
    $company->save();

    // Update concerned person details
    $concernedPerson = ConcernedPerson::where('company_id', $company->id)->firstOrFail();
    $concernedPerson->name = $request->concerned_person_name;
    $concernedPerson->designation = $request->concerned_person_designation;
    $concernedPerson->email = $request->concerned_person_email;
    $concernedPerson->phone = $request->concerned_person_phone;
    $concernedPerson->save();

    // delete and re-create founder details
    $company->founders()->where('company_id',$company->id)->delete();
    if ($request->has('founder_name')) {
        foreach ($request->founder_name as $index => $name) {   
            $founder = new Founder();
            $founder->company_id = $company->id;
            $founder->name = $name;
            $founder->position = $request->founder_position[$index];
            $founder->education = $request->founder_education[$index];
            $founder->experience = $request->founder_experience[$index];
            $founder->save();
        }
    }
    // delete and re-create fund requirements where id matches
    $company->fundRequirements()->where('company_id', $company->id)->delete();
    if ($request->has('fund_usage')) {
        foreach ($request->fund_usage as $index => $usage) {
            $fundRequirement = new FundRequirement();
            $fundRequirement->company_id = $company->id;
            $fundRequirement->usage = $usage;
            $fundRequirement->amount = $request->fund_requirement[$index];
            $fundRequirement->unit = $request->fund_unit[$index];
            $fundRequirement->save();
        }
    }   

    // delete and re-create previous rounds
    $company->previousRounds()->where('investee_id', $company->id)->delete();
    if ($request->has('previous_rounds')) {
        foreach ($request->previous_rounds as $index => $round) {
            $previousRound = new PreviousRound();
            $previousRound->investee_id = $company->id;
            $previousRound->round = $round;
            $previousRound->investor = $request->investors[$index];     
            $previousRound->amount_raised = $request->amount_raised[$index];
            $previousRound->valuation = $request->valuation[$index];
            $previousRound->save();
        }
    }
    // delete and re-create attachments
    $company->attachments()->where('investee_id', $company->id)->delete();
    if ($request->hasFile('financials')) {
        foreach ($request->file('financials') as $file) {
            $attachment = new Attachment();
            $attachment->investee_id = $company->id;
            $attachment->type = "financials"; // Assuming you want to store the file type
            $attachment->fiscal_year = $request->fiscal_year; // Assuming you have a fiscal year field in the form
            $attachment->file_path = $file->store('financials');
            $attachment->save();
        }
    }
    // delete and re-create other links
    $company->otherLinks()->where('company_id', $company->id)->delete();
    if ($request->has('other_links')) {
        foreach ($request->other_links as $index => $link) {
            $otherLink = new OtherLink();
            $otherLink->company_id = $company->id;      
            $otherLink->link_url = $link;
            $otherLink->link_description = $request->link_descriptions[$index] ?? null;
            $otherLink->save();
        }
    }

    // delete and re-create attachments for pitch deck if new file is uploaded
    $company->attachments()->where('investee_id', $company->id)->where('type', 'pitch_deck')->delete();
    if ($request->hasFile('pitch_deck')) {
        $pitchDeck = new Attachment();
        $pitchDeck->investee_id = $company->id;
        $pitchDeck->type = 'pitch_deck'; // Assuming you want to store the file type
        $pitchDeck->fiscal_year = date('Y'); // Assuming you have a fiscal year field in the form
        $pitchDeck->file_path = $request->file      
        ('pitch_deck')->store('pitch_decks');
        $pitchDeck->save();
    }
    


    // update referral source
    $referralSource = ReferralSource::where('investee_id', $company->id)->first();
    if ($referralSource) {
        $referralSource->source = $request->referral_source;
        $referralSource->save();
    } else {
        $referralSource = new ReferralSource();
        $referralSource->investee_id = $company->id;
        $referralSource->source = $request->referral_source;
        $referralSource->save();
    }   

    $guidanceNeeded = $company->guidanceNeeded()->get();
    // update or create guidance needed
    if ($request->has('guidance_needed')) {
        foreach ($request->guidance_needed as $index => $guidance) {
            $guidanceNeeded = new GuidanceNeeded();
            $guidanceNeeded->investee_id = $company->id;        
            $guidanceNeeded->guidance_needed = $guidance;
            $guidanceNeeded->save();
        }
    }

    // Handle other updates like founders, fund requirements, etc.
    
    // Mark the user as having completed the form
    $user = auth()->user();
    $user->form_filled = 1; // Assuming this field exists in the User model
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Investee form updated successfully!');
}


}
