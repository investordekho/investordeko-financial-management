<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ConcernedPerson;
use App\Models\Founder;
use App\Models\FundRequirement;
use App\Models\PreviousRound;
use App\Models\OtherLink;
use App\Models\Attachment;
use App\Models\ReferralSource;
use Illuminate\Http\Request;
USE App\Models\investee_guidance_needed_model;
USE App\Mail\GuidanceNeededInvesteeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FormSubmissionController extends Controller
{
   public function store1(Request $request)
{
    $user = Auth::user();
    $user->form_filled = true;
    $user->save();

    $request->validate([
        'company_name' => 'required|string',
        'address' => 'required|string',
        'nature_of_business' => 'required|string',
        'incorporated_in' => 'required|integer',
        'concerned_person_name' => 'required|string',
        'concerned_person_email' => 'required|email',
        'concerned_person_designation' => 'required|string',
        'concerned_person_phone' => 'required|string',
        'founder_name.*' => 'required|string',
        'fund_usage.*' => 'required|string',
        'fund_requirement.*' => 'required|numeric',
        'previous_rounds.*' => 'required|string',
        'investors.*' => 'required|string',
        'amount_raised.*' => 'required|numeric',
        'valuation.*' => 'required|numeric',
        'public_links.*' => 'nullable|url',
        'link_descriptions.*' => 'nullable|string',
        'pitch_deck' => 'required|file|mimes:ppt,pptx,pdf,doc,docx',
        'referral_source' => 'required|string',
        'website' => 'required|url',
        'linkedin' => 'required|url',
        'fiscal_year.*' => 'required|integer|digits:4',
        'financials.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
        'other_attachment'=>'nullable|file',
    ]);

    // Store company details
    $company = Company::create([
        'user_id' => Auth::id(),
        'company_name' => $request->company_name,
        'address' => $request->address,
        'nature_of_business' => $request->nature_of_business,
        'incorporated_in' => $request->incorporated_in,
        'website' => $request->website ?? null,
        'linkedin' => $request->linkedin ?? null,
    ]);

    // Store concerned person details
    ConcernedPerson::create([
        'company_id' => $company->id,
        'name' => $request->concerned_person_name,
        'designation' => $request->concerned_person_designation,
        'email' => $request->concerned_person_email,
        'phone' => $request->concerned_person_phone,
    ]);

    // Store founder details
    foreach ($request->founder_name as $index => $name) {
        Founder::create([
            'company_id' => $company->id,
            'name' => $name,
            'position' => isset($request->founder_position[$index]) ? $request->founder_position[$index] : null,
            'education' => isset($request->founder_education[$index]) ? $request->founder_education[$index] : null,
            'experience' => isset($request->founder_experience[$index]) ? $request->founder_experience[$index] : null,
        ]);
    }

    // Store fund requirements
    foreach ($request->fund_usage as $index => $usage) {
        FundRequirement::create([
            'company_id' => $company->id,
            'usage' => $usage,
            'requirement' => $request->fund_requirement[$index],
            'unit' => isset($request->fund_unit[$index]) ? $request->fund_unit[$index] : null,
            'amount' => isset($request->amount[$index]) ? $request->amount[$index] : 0,
        ]);
    }

    // Store previous rounds
    foreach ($request->previous_rounds as $index => $round) {
        PreviousRound::create([
            'company_id' => $company->id,
            'round' => $round,
            'investors' => isset($request->investors[$index]) ? $request->investors[$index] : '',
            'amount_raised' => isset($request->amount_raised[$index]) ? $request->amount_raised[$index] : 0,
            'valuation' => isset($request->valuation[$index]) ? $request->valuation[$index] : 0,
        ]);
    }

    // Store other links
    if($request->public_links){
        foreach ($request->public_links as $index => $link) {
            OtherLink::create([
                'company_id' => $company->id,
                'link_url' => $link,
                'link_description' => isSet($request->link_descriptions[$index]) ? $request->link_descriptions[$index]:'other',
            ]);
        }
    }
    

    // Store attachments (Pitch Deck)
    if ($request->hasFile('pitch_deck')) {
        $path = $request->file('pitch_deck')->store('attachments', 'public');
        Attachment::create([
            'company_id' => $company->id,
            'type' => 'pitch_deck',
            'file_path' => $path,
        ]);
    }

    // Store financial attachments
    if ($request->hasFile('financials')) {
        foreach ($request->file('financials') as $index => $financial) {
            // Check fiscal year exists for this index
            if (!isset($request->fiscal_year[$index])) {
                continue;
            }

            $fiscalYear = $request->fiscal_year[$index];

            // Store the file and save to the database
            $path = $financial->store('attachments', 'public');
            Attachment::create([
                'company_id' => $company->id,
                'type' => 'financials',
                'fiscal_year' => $fiscalYear,
                'file_path' => $path,
            ]);
        }
    }

    if($request->hasFile('other_attachment')){
        $path = $request->file('other_attachment')->store('attachments','public');
        Attachment::create([
            'company_id'=>$company_id,
            'type'=>'other_attachment',
            'file_path'=>$path,
        ]);
    }

    // Store referral source
    ReferralSource::create([
        'company_id' => $company->id,
        'source_name' => $request->referral_source,
    ]);

    if ($user->category_id == 1) {
        return redirect()->route('investee.dashboard')->with('success', 'Form submitted successfully!');
    }

    return redirect()->route('investee.dashboard')->with('success', 'Form submitted successfully!');
}
       
public function store(Request $request)
{
    $user = Auth::user();
    $user->form_filled = true;
    $user->save();

    $request->validate([
        'company_name' => 'required|string',
        'address' => 'required|string',
        'nature_of_business' => 'required|string',
        'incorporated_in' => 'required|integer',
        'concerned_person_name' => 'required|string',
        'concerned_person_email' => 'required|email',
        'concerned_person_designation' => 'required|string',
        'concerned_person_phone' => 'required|string', //
        'founder_name.*' => 'required|string', //
        'founder_position.*'=>'required|string', //
        'founder_education.*'=>'required|string', //
        'founder_experience.*' => 'required|numeric', //
        'fund_usage.*' => 'required|string', //
        'fund_requirement.*' => 'required|numeric', //
        'previous_rounds.*' => 'required|string', //
        'investors.*' => 'required|string', //
        'amount_raised.*' => 'required|numeric', //
        'valuation.*' => 'required|numeric', //
        'public_links.*' => 'nullable|url', //
        'link_descriptions.*' => 'nullable|string', //
        'pitch_deck' => 'required|file|mimes:ppt,pptx,pdf,doc,docx|max:2048', //
        'referral_source' => 'required|string', //
        'website' => 'required|url', //
        'linkedin' => 'required|url', //
        'fiscal_year.*' => 'required|integer|digits:4', //
        'financials.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048', //
        'guidance_needed.*' => 'nullable|string', //
        'other_attachment'=>'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048', //
    ]);

    // \Log::info('Financial Count:', ['count' => count($request->file('financials'))]);
    // foreach ($request->file('financials') as $index => $f) {
    //     \Log::info("File $index: " . $f->getClientOriginalName());
    // }

    // foreach ($request->file('financials') as $index => $financialFile) {
    //     \Log::info("Checking fiscal_year index $index", ['value' => $request->fiscal_year[$index] ?? 'MISSING']);
    // }
    // foreach ($request->fiscal_year as $i => $fy) {
    //     \Log::info("Fiscal Year [$i]:", ['value' => $fy]);
    // }

    // Store company details
    $company = Company::create([
        'user_id' => Auth::id(),
        'company_name' => $request->company_name,
        'address' => $request->address,
        'nature_of_business' => $request->nature_of_business,
        'incorporated_in' => $request->incorporated_in,
        'website' => $request->website ?? null,
        'linkedin' => $request->linkedin ?? null,
    ]);

    // Store concerned person details
    ConcernedPerson::create([
        'company_id' => $company->id,
        'name' => $request->concerned_person_name,
        'designation' => $request->concerned_person_designation,
        'email' => $request->concerned_person_email,
        'phone' => $request->concerned_person_phone,
    ]);

    // Store founder details
    foreach ($request->founder_name as $index => $name) {
        Founder::create([
            'company_id' => $company->id,
            'name' => $name,
            'position' => isset($request->founder_position[$index]) ? $request->founder_position[$index] : null,
            'education' => isset($request->founder_education[$index]) ? $request->founder_education[$index] : null,
            'experience' => isset($request->founder_experience[$index]) ? $request->founder_experience[$index] : null,
        ]);
    }

    // Store fund requirements
    foreach ($request->fund_usage as $index => $usage) {
        FundRequirement::create([
            'company_id' => $company->id,
            'usage' => $usage,
            'requirement' => $request->fund_requirement[$index],
            'unit' => isset($request->fund_unit[$index]) ? $request->fund_unit[$index] : null,
            'amount' => isset($request->fund_requirement[$index]) ? $request->fund_requirement[$index] : 0,
            // 'amount' => isset($request->amount[$index]) ? $request->amount[$index] : 0,
        ]);
    }

    // Store previous rounds
    foreach ($request->previous_rounds as $index => $round) {
        PreviousRound::create([
            'company_id' => $company->id,
            'round' => $round,
            'investors' => isset($request->investors[$index]) ? $request->investors[$index] : '',
            'amount_raised' => isset($request->amount_raised[$index]) ? $request->amount_raised[$index] : 0,
            'valuation' => isset($request->valuation[$index]) ? $request->valuation[$index] : 0,
        ]);
    }

    // Store other links
    if($request->public_links){
        foreach ($request->public_links as $index => $link) {
            if(!empty($link)){
                OtherLink::create([
                    'company_id' => $company->id,
                    'link_url' => $link,
                    'link_description' => isSet($request->link_descriptions[$index]) ? $request->link_descriptions[$index]:'other',
                ]);
            }
        }
    }

 // Store pitch deck
    if ($request->hasFile('pitch_deck')) {
        $file = $request->file('pitch_deck');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        $file->storeAs('attachments', $filename, 'public'); // ✅ specify disk 'public'

        Attachment::create([
            'company_id' => $company->id,
            'type' => 'pitch_deck',
            'file_path' => 'attachments/' . $filename,
        ]);
    }



    if ($request->hasFile('financials')) {
        foreach ($request->file('financials') as $index => $financialFile) {
            if (!isset($request->fiscal_year[$index])) continue;

            $fiscalYear = $request->fiscal_year[$index];
            $filename = Str::random(40) . '.' . $financialFile->getClientOriginalExtension();

            $financialFile->storeAs('attachments', $filename, 'public'); // ✅ use 'public' disk

            Attachment::create([
                'company_id' => $company->id,
                'type' => 'financials',
                'fiscal_year' => $fiscalYear,
                'file_path' => 'attachments/' . $filename,
            ]);
        }
    }



    if ($request->hasFile('other_attachment')) {
        $file = $request->file('other_attachment');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        $file->storeAs('attachments', $filename, 'public'); // ✅ use 'public' disk

        Attachment::create([
            'company_id' => $company->id,
            'type' => 'other',
            'file_path' => 'attachments/' . $filename,
        ]);
    }



    // Store referral source
    ReferralSource::create([
        'company_id' => $company->id,
        'source_name' => $request->referral_source,
    ]);

    if ($request->has('guidance_needed')) {
        foreach ($request->guidance_needed as $index => $guidance) {
            $guidanceNeeded = new investee_guidance_needed_model();
            $guidanceNeeded->company_id = $company->id;
            $guidanceNeeded->guidance_needed = $guidance;
            $guidanceNeeded->save();
        }
    }
    if($request->has('guidance_needed') && Auth::check()){
        $user = Auth::user();
        $email = $user->email;
        $subscriptionRequest = [
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'concern_person_name' => $request->concerned_person_name,
            'concern_person_phone' => $request->concerned_person_phone,
            'concern_person_email' => $request->concerned_person_email,
            'concern_person_designation' => $request->concerned_person_designation,          
            'company_name' => $request->company_name,
            'company_website' => $request->website ?? null,
            'guidance_needed' => is_array($request->guidance_needed)
                ? implode(', ', $request->guidance_needed)
                : $request->guidance_needed,
        ];
        // mail to admin 
        Mail::to('investordekhopoojad@gmail.com')->send(new GuidanceNeededInvesteeMail($subscriptionRequest));
    }
    if ($user->category_id == 1) { 
       
        return redirect()->route('investee.dashboard')->with('success', 'Form submitted successfully!');
    }

    return redirect()->route('investee.dashboard')->with('success', 'Form submitted successfully!');
}
}
