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
        try {
            // Validate the request
            $request->validate([
                'investor_name' => 'required|string|max:255',
                'sectors_preferred' => 'required|array',
                'address' => 'required|string',
                'concerned_person_name' => 'required|string',
                'concerned_person_designation' => 'required|string',
                'concerned_person_phone' => 'required|digits:20',
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
                'investor_profile' => 'nullable|file', // Accepts all file types
                'other_guidance' => 'nullable|string',
            ]);

            $filePath = null;
            if ($request->hasFile('investor_profile')) {
                $filePath = $request->file('investor_profile')->store('investor_profiles', 'public');
            }

            $sectors_preferred = implode(',', $request->input('sectors_preferred'));

            $investor = Investor::create([
                'user_id' => Auth::id(),
                'investor_name' => $request->investor_name,
                'address' => $request->address,
                'investor_profile' => $filePath,
                'sectors_preferred' => $sectors_preferred,
            ]);

            ContactDetail::create([
                'investor_id' => $investor->id,
                'concerned_person_name' => $request->concerned_person_name,
                'concerned_person_designation' => $request->concerned_person_designation,
                'concerned_person_phone' => $request->concerned_person_phone,
                'email' => $request->email,
            ]);

            if ($request->has('public_links') && is_array($request->public_links)) {
                $linkDescriptions = $request->input('link_descriptions', []);
                foreach ($request->public_links as $index => $url) {
                    PublicLink::create([
                        'investor_id' => $investor->id,
                        'url' => $url,
                        'link_description' => isset($linkDescriptions[$index]) ? $linkDescriptions[$index] : null,
                    ]);
                }
            }

            InvestmentDetail::create([
                'investor_id' => $investor->id,
                'invest_in' => $request->invest_in,
                'investor_type' => $request->investor_type,
                'investment_size' => $request->investment_size,
                'investment_tenure' => $request->investment_tenure,
            ]);

            if ($request->has('previous_investment_year') && is_array($request->previous_investment_year)) {
                $previousCompanies = $request->input('previous_investment_company', []);
                $sectors = $request->input('sector', []);
                foreach ($request->previous_investment_year as $index => $year) {
                    PreviousInvestment::create([
                        'investor_id' => $investor->id,
                        'previous_investment_year' => $year,
                        'previous_investment_company' => isset($previousCompanies[$index]) ? $previousCompanies[$index] : null,
                        'sector' => isset($sectors[$index]) ? $sectors[$index] : null,
                    ]);
                }
            }

            Referral::create([
                'investor_id' => $investor->id,
                'referral_source' => $request->referral_source,
            ]);

            if ($request->has('guidance_needed')) {
                foreach ($request->guidance_needed as $guidance) {
                    GuidanceNeed::create([
                        'investor_id' => $investor->id,
                        'guidance_needed' => is_array($guidance) ? implode(',', $guidance) : $guidance,
                        'other_guidance' => $request->other_guidance ?? null,
                    ]);
                }
            }

            $user = Auth::user();
            $user->form_filled = true;
            $user->save();

            return redirect()->route('investor.dashboard')->with('success_message', 'Investor profile created successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Investor storing error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            // Output error to browser console (for debugging in development)
            echo "<script>console.log('Investor storing error: " . addslashes($e->getMessage()) . "');</script>";
            // Show error message in the session (flash)
            session()->flash('error_message', $e->getMessage());
            // Optionally, you can return the error as a response for AJAX
            // return response()->json(['error' => $e->getMessage()], 500);
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
