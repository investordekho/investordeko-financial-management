<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banker;
use App\Models\BankerContactDetail;
use App\Models\BankerPublicLink;
use App\Models\BankerPreviousDeal;
use App\Models\BankerReferral;
use App\Models\Investee;
use App\Models\Investor;
use App\Models\SectorDetail;
use App\Models\Company;
use App\Models\Subscriber;
use App\Models\LocationDetail;
use Illuminate\Support\Facades\Auth;

class BankerController extends Controller
{
    public function index()
    {
        // Get the logged-in user's ID
        $userId = auth()->user()->id;

        // Check if the user is subscribed
        $subscriber = Subscriber::where('user_id', $userId)->first();
        $investors = Investor::all(); // Or apply any other logic for fetching investors

        // Fetch investees (companies)
        $investees = Company::with(['user', 'fundRequirements', 'previousRounds'])->get();

        // Fetch sectors and locations
        $sectors = SectorDetail::all();
        $locations = LocationDetail::all();
        
        return view('dashboards.banker', compact('investees', 'sectors', 'locations'));
    }
    
    public function showForm()
{
    return view('banker.form');  // Assuming you have a view file for the form
}


    public function store(Request $request)
    {
        // Step 1: Validate form input
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'incorporated_in' => 'required|integer|min:1900|max:' . date('Y'),
            'ib_team_size' => 'required|string',
            'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'min_fund_raise_size' => 'required|string',
            'max_fund_raise_size' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'concerned_person_designation' => 'required|string',
            'public_links.*' => 'required|url',
            'link_descriptions.*' => 'required|string',
            'previous_deal_year.*' => 'required|integer|min:1900|max:' . date('Y'),
            'previous_deal_company.*' => 'required|string',
            'previous_deal_sector.*' => 'required|string',
            'previous_deal_type.*' => 'required|string',
            'referral_source' => 'required|string',
        ]);

        // Step 2: Handle file upload for company profile
        $filePath = null;
        if ($request->hasFile('company_profile')) {
            $filePath = $request->file('company_profile')->store('company_profiles', 'public');
        }

        // Step 3: Store banker information
        $banker = Banker::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'incorporated_in' => $request->incorporated_in,
            'ib_team_size' => $request->ib_team_size,
            'company_profile' => $filePath,
            'address' => $request->address,
            'location' => $request->location,
            'state' => $request->state,
            'country' => $request->country,
            'min_fund_raise_size' => $request->min_fund_raise_size,
            'max_fund_raise_size' => $request->max_fund_raise_size,
        ]);

        // Step 4: Store contact details
        BankerContactDetail::create([
            'banker_id' => $banker->id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'concerned_person_designation' => $request->concerned_person_designation,
        ]);

        // Step 5: Store public links
        if ($request->has('public_links')) {
            foreach ($request->public_links as $index => $url) {
                BankerPublicLink::create([
                    'banker_id' => $banker->id,
                    'url' => $url,
                    'link_description' => $request->link_descriptions[$index],
                ]);
            }
        }

        // Step 6: Store previous deals
        if ($request->has('previous_deal_year')) {
            foreach ($request->previous_deal_year as $index => $year) {
                BankerPreviousDeal::create([
                    'banker_id' => $banker->id,
                    'previous_deal_year' => $year,
                    'previous_deal_company' => $request->previous_deal_company[$index],
                    'previous_deal_sector' => $request->previous_deal_sector[$index],
                    'previous_deal_type' => $request->previous_deal_type[$index],
                ]);
            }
        }

        // Step 7: Store referral
        BankerReferral::create([
            'banker_id' => $banker->id,
            'referral_source' => $request->referral_source,
        ]);

        // Step 8: Mark the form as filled in the user's record
        $user = Auth::user();
        $user->form_filled = true;
        $user->save();

        // Step 9: Redirect to dashboard
        return redirect()->route('banker.dashboard')->with('success_message', 'Banker profile created successfully!');
    }

  public function filterInvestees(Request $request)
{
    $query = Company::query(); // Start a query on the Company model

    // Filter by location (address column in the companies table)
    if ($request->filled('location')) {
        $query->whereIn('address', $request->location);
    }

    // Filter by nature of business
    if ($request->filled('nature_of_business')) {
        $query->whereIn('nature_of_business', $request->nature_of_business);
    }

    // Filter by incorporated year
    if ($request->filled('incorporated_in')) {
        $query->whereIn('incorporated_in', $request->incorporated_in);
    }

    // Filter by usage of fund (from fund_requirements table)
    if ($request->filled('fund_usage')) {
        $query->whereHas('fundRequirements', function ($q) use ($request) {
            $q->whereIn('usage', $request->fund_usage);
        });
    }

    // Fetch the filtered investees along with their fund requirements
    $investees = $query->with('fundRequirements')->get();

    // Return the filtered investees as JSON
    return response()->json([
        'investees' => $investees
    ]);
}


     public function searchinvestor(Request $request)
{
    // Get the logged-in user's ID
    $userId = auth()->user()->id;

    // Check if the user is subscribed
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Start building the query
    $query = Investor::query();

    // Filter based on sectors (match any sector using LIKE)
    $sectors = $request->input('nature_of_business', []);
    if (!empty($sectors)) {
        $query->where(function ($q) use ($sectors) {
            foreach ($sectors as $sector) {
                $q->orWhere('sectors_preferred', 'LIKE', '%' . $sector . '%');
            }
        });
    }

    // Filter based on location
    $locations = $request->input('location', []);
    if (!empty($locations)) {
        $query->whereIn('address', $locations);
    }

    // Join with the investment_details table to filter based on investment size, tenure, and type
    $query->join('investment_details', 'investment_details.investor_id', '=', 'investors.id');

    // Filter based on investment size
    $investmentSizes = $request->input('investment_size', []);
    if (!empty($investmentSizes)) {
        $query->whereIn('investment_details.investment_size', $investmentSizes);
    }

    // Filter based on investment tenure
    $investmentTenures = $request->input('investment_tenure', []);
    if (!empty($investmentTenures)) {
        $query->whereIn('investment_details.investment_tenure', $investmentTenures);
    }

    // Filter based on investor type
    $investorTypes = $request->input('investor_type', []);
    if (!empty($investorTypes)) {
        $query->whereIn('investment_details.investor_type', $investorTypes);
    }

    // Handle sorting
    $sort = $request->input('sort', null);
    if ($sort == 'A-Z') {
        $query->orderBy('investor_name', 'asc');
    } elseif ($sort == 'Z-A') {
        $query->orderBy('investor_name', 'desc');
    } elseif ($sort == 'investment_size_asc') {
        $query->orderBy('investment_details.investment_size', 'asc');
    } elseif ($sort == 'investment_size_desc') {
        $query->orderBy('investment_details.investment_size', 'desc');
    }

    // Fetch the results
    $investors = $query->select('investors.*')->distinct()->get();

    // Return the filtered results with a view for display
    return view('partials.investor_list', compact('investors', 'subscriber'))->render();
    return view('partials.investor_list', compact('investors'))->render();
}


   public function showBankerDashboard()
{
    // Fetch sectors and locations
    $sectors = SectorDetail::all();
    $locations = LocationDetail::all();

    // Pass the data to the view
    return view('dashboards.banker', compact('sectors', 'locations'));
}


public function search(Request $request)
{
    // Get the logged-in user's ID
    $userId = auth()->user()->id;

    // Check if the user is subscribed
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Retrieve the search criteria from the request
    $address = $request->input('location', []); 
    $nature_of_business = $request->input('nature_of_business', []); 
    $incorporated_in = $request->input('incorporated_in', null);
    $fund_usage = $request->input('fund_usage', null);

    // Start building the query for filtering companies (investees)
    $query = Company::query();

    // Apply filters
    if (!empty($address)) {
        $query->whereIn('address', $address); 
    }

    if (!empty($nature_of_business)) {
        $query->whereIn('nature_of_business', $nature_of_business); 
    }

    if (!empty($incorporated_in)) {
        $query->where('incorporated_in', $incorporated_in); 
    }

    if (!empty($fund_usage)) {
        $query->whereHas('fundRequirements', function ($q) use ($fund_usage) {
            $q->where('usage', $fund_usage); 
        });
    }

    // Fetch the filtered results
    $investees = $query->with(['user', 'fundRequirements', 'previousRounds'])->get();

    // Pass investees and subscriber to the partial view for the banker dashboard
    return view('partials.investee_list', compact('investees', 'subscriber'))->render();
}

}
