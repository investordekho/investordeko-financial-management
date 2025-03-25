<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Subscriber;
use App\Models\User;

class InvesteeDashboardController extends Controller
{
    /**
     * Show the Investee Dashboard.
     */
    public function index1()
    {
        // Get the logged-in user's ID
        $userId = auth()->user()->id;

        // Check if the user is subscribed
        $subscriber = Subscriber::where('user_id', $userId)->first();

        // Fetch investors with their related public links and previous investments
        // $investorsQuery = Investor::with(['publicLinks', 'previousInvestments', 'investmentDetails']);
        $investorsQuery = Investor::with(['contactDetails','publicLinks', 'previousInvestments', 'investmentDetails','referrals','guidanceNeeds','public_links','investorAddresses']);
        // Apply limits based on subscription status
        if ($subscriber && $subscriber->is_subscribed) {
            // Fetch 10 results for subscribed users
            $investors = $investorsQuery->take(10)->get();
        } else {
            // Fetch 3 results for unsubscribed users
            $investors = $investorsQuery->take(3)->get();
        }
        // foreach ($investors as $investor) {
        //     if ($investor->investmentDetails) {
        //         dd($investor->investmentDetails->investment_size);
        //     }
        // }
        
        // dd($investors);        
        
        // foreach ($investors as $investor) {
        //     if (!$investor->contactDetails) {
        //         \Log::info("Investor {$investor->investor_name} has no contact details.");
        //     }
        // }
        
        // Return the investee dashboard view with investors and subscriber data
        return view('dashboards.investee', compact('investors', 'subscriber'));
    }
    public function index()
{
    $userId = auth()->user()->id;
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Fetch investors with related data
    $investorsQuery = Investor::with([
        'contactDetails', 'publicLinks', 'previousInvestments',
        'investmentDetails', 'referrals', 'guidanceNeeds', 'investorAddresses'
    ]);

    $investors = ($subscriber && $subscriber->is_subscribed) ? 
        $investorsQuery->take(10)->get() : 
        $investorsQuery->take(3)->get();

    return view('dashboards.investee', compact('investors', 'subscriber'));
}


    /**
     * Search for investors based on filter criteria.
     */
   public function search(Request $request)
{
    // Get the logged-in user's ID
    $userId = auth()->user()->id;

    // Check if the user is subscribed
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Start building the query with a join to investment_details table
    $query = Investor::query()->with('investmentDetails');

    // Filter based on sectors (match any sector using LIKE)
    $sectors = $request->input('sector', []);
    if (!empty($sectors)) {
        $query->where(function ($q) use ($sectors) {
            foreach ($sectors as $sector) {
                $q->orWhere('sectors_preferred', 'LIKE', '%' . $sector . '%');
            }
        });
    }

    // Filter based on location (address)
    $locations = $request->input('location', []);
    if (!empty($locations)) {
        $query->where(function ($q) use ($locations) {
            foreach ($locations as $location) {
                $q->orWhere('address', 'LIKE', '%' . $location . '%');
            }
        });
    }

    // Join with the investment_details table to filter based on investment size, tenure, and type
    $query->join('investment_details', 'investment_details.investor_id', '=', 'investors.id');

    // Filter based on investment size
    $investmentSizes = $request->input('investment_size', []);
    if (!empty($investmentSizes)) {
        $query->where(function ($q) use ($investmentSizes) {
            foreach ($investmentSizes as $size) {
                $q->orWhere('investment_details.investment_size', 'LIKE', '%' . $size . '%');
            }
        });
    }

    // Filter based on investment tenure
    $investmentTenures = $request->input('investment_tenure', []);
    if (!empty($investmentTenures)) {
        $query->where(function ($q) use ($investmentTenures) {
            foreach ($investmentTenures as $tenure) {
                $q->orWhere('investment_details.investment_tenure', 'LIKE', '%' . $tenure . '%');
            }
        });
    }

    // Filter based on investor type
    $investorTypes = $request->input('investor_type', []);
    if (!empty($investorTypes)) {
        $query->where(function ($q) use ($investorTypes) {
            foreach ($investorTypes as $type) {
                $q->orWhere('investment_details.investor_type', 'LIKE', '%' . $type . '%');
            }
        });
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

    // Determine the number of results based on subscription status
    $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
    $investors = $query->select('investors.*')->distinct()->take($limit)->get();

    // Return a partial view containing only the investor list and subscriber data
    return view('partials.investor_list', compact('investors', 'subscriber'));
}

public function investeedetaildashboard($id)
{
     // Fetch the investor with the given ID
     $investor = Investor::with(['contactDetails','publicLinks', 'previousInvestments', 'investmentDetails','referrals','guidanceNeeds','public_links','investorAddresses'])->find($id);

     if(!$investor){
          // Redirect back with an error message if the investor is not found 
           return redirect()->back()->with('error', 'Investor not found');
     }

     return view('partials.investor_list_detail', compact('investor'));
}
}
