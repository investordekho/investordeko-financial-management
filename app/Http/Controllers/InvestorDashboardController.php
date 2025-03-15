<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Subscriber;
use App\Models\SectorDetail;
use App\Models\LocationDetail;

class InvestorDashboardController extends Controller
{
    /**
     * Display the investor dashboard with investee data and filters.
     *
     * @return \Illuminate\View\View
     */
    public function indexe()
{
    // Get the logged-in user's ID
    $userId = auth()->user()->id;

    // Check if the user is subscribed
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Fetch investees (companies)
    $investees = Company::with(['user', 'fundRequirements', 'previousRounds'])->get();

    // Fetch sectors and locations
    $sectors = SectorDetail::all();
    $locations = LocationDetail::all();

    // Pass investees, sectors, locations, and subscriber to the view
    return view('dashboards.investordashboard', compact('investees', 'sectors', 'locations', 'subscriber'));
}
   public function index()
   {
       $userId = auth()->user()->id;
       $subscriber = Subscriber::where('user_id',$userId)->first();
       $investeesQuery = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource']);
       $sectors = SectorDetail::all();
       $locations =LocationDetail::all();

       if($subscriber && $subscriber->is_subscribed){
            $investees = $investeesQuery->limit(10)->get();
       }
       else
       {
            $investees = $investeesQuery->limit(3)->get();
       }
       return view('dashboards.investordashboard',compact('subscriber','investees','sectors','locations'));
   }
    /**
     * Search function for filtering investees.
     */
    public function search(Request $request)
    {
        // Get the logged-in user's ID
        $userId = auth()->user()->id;

        // Check if the user is subscribed
        $subscriber = Subscriber::where('user_id', $userId)->first();

        // Retrieve the search criteria from the request
        $address = $request->input('location', []); // The field name in the form is 'location'
        $nature_of_business = $request->input('nature_of_business', []); // Field for sector/nature of business
        $incorporated_in = $request->input('incorporated_in', null);
        $fund_usage = $request->input('fund_usage', null);

        // Start building the query
        $query = Company::query();

        // Apply filters
        if (!empty($address)) {
            $query->whereIn('address', $address); // Match the location with address in the companies table
        }

        if (!empty($nature_of_business)) {
            $query->whereIn('nature_of_business', $nature_of_business); // Filter by sector/nature of business
        }

        if (!empty($incorporated_in)) {
            $query->where('incorporated_in', $incorporated_in); // Filter by incorporation year
        }

        if (!empty($fund_usage)) {
            $query->whereHas('fundRequirements', function ($q) use ($fund_usage) {
                $q->where('usage', $fund_usage); // Filter by usage of funds
            });
        }

        // Fetch the filtered results
        $investeesdata = $query->with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])->get();

        
       if($subscriber && $subscriber->is_subscribed){
                $investees = $investeesdata->take(10)->values();
        }
        else
        {
                $investees = $investeesdata->take(3)->values();
        }
        // Pass investees and subscriber to the partial view
        return view('partials.investee_list', compact('investees', 'subscriber'))->render();
    }


    public function investordetaildashboard($id)
    {
        // $id = $request->input('id');

        $investee = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])->find($id);
        
        if(!$investee){
            abort(404,'investee not found');
        }
        return view('partials.investee_list_detail',compact('investee'));
    }
}
