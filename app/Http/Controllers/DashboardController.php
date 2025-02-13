<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Investee;
use App\Models\Banker;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Fetch the related investor data
        $investor = Investor::where('user_id', $user->id)->first();
        $contactDetail = ContactDetail::where('investor_id', $investor->id)->first();
        $publicLinks = PublicLink::where('investor_id', $investor->id)->get();
        $investmentDetail = InvestmentDetail::where('investor_id', $investor->id)->first();
        $previousInvestments = PreviousInvestment::where('investor_id', $investor->id)->get();
        $referral = Referral::where('investor_id', $investor->id)->first();
        $guidanceNeeds = GuidanceNeed::where('investor_id', $investor->id)->get();

        return view('investordashboard', compact(
            'investor', 
            'contactDetail', 
            'publicLinks', 
            'investmentDetail', 
            'previousInvestments', 
            'referral', 
            'guidanceNeeds'
        ));
    }
        
    public function bankerDashboard()
    {
        // Return banker dashboard view
        return view('bankerdashboard');
    }

    // New method for 'other' category dashboard
    public function otherDashboard()
    {
        // Return other dashboard view
        return view('otherdashboard');
    }
    
    public function show(Request $request)
    {
        $searchQuery = $request->input('search'); // Retrieve search term
        $userType = $request->input('user_type'); // Retrieve user type filter (Investee, Investor, etc.)

        // Store search history for tracking
        if ($searchQuery) {
            SearchHistory::create([
                'user_id' => Auth::id(), // Store only if user is logged in
                'search_term' => $searchQuery,
                'user_type' => $userType
            ]);
        }

        // Default empty results
        $results = collect();

        // Determine which model to search based on user type
        if ($userType == 'investee') {
            // Search in Investee model
            $results = Investee::where('name', 'like', '%' . $searchQuery . '%')
                               ->orWhere('sector', 'like', '%' . $searchQuery . '%')
                               ->get();
        } elseif ($userType == 'investor') {
            // Search in Investor model
            $results = Investor::where('name', 'like', '%' . $searchQuery . '%')
                               ->orWhere('investment_focus', 'like', '%' . $searchQuery . '%')
                               ->get();
        } elseif ($userType == 'banker') {
            // Search in Banker model
            $results = Banker::where('name', 'like', '%' . $searchQuery . '%')
                             ->orWhere('field_of_specialization', 'like', '%' . $searchQuery . '%')
                             ->get();
        }

        // Check if the user is logged in
        if (Auth::check()) {
            // Redirect to user-specific dashboards based on their category or user type
            if ($userType == 'investee') {
                return redirect()->route('investee.dashboard')->with('results', $results);
            } elseif ($userType == 'investor') {
                return redirect()->route('investor.dashboard')->with('results', $results);
            } elseif ($userType == 'banker') {
                return redirect()->route('banker.dashboard')->with('results', $results);
            } else {
                // General dashboard for logged-in users if no specific type
                return view('dashboard.dashboard', [
                    'results' => $results,
                    'searchQuery' => $searchQuery,
                    'userType' => $userType
                ]);
            }
        } else {
            // If not logged in, redirect to general dashboard page
            return view('dashboard', [
                'results' => $results,
                'searchQuery' => $searchQuery,
                'userType' => $userType
            ]);
        }
    }
}

