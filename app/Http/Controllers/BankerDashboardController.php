<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; // Assuming investees are fetched from the Company model
use App\Models\Investor; // Assuming investors are fetched from the Investor model
use App\Models\Subscriber;

class BankerDashboardController extends Controller
{
    public function index()
    {
        // Get the logged-in user's ID
        $userId = auth()->user()->id;

        // Fetch data for investees and investors
        $investees = Company::with(['user', 'fundRequirements', 'previousRounds'])->get();
        $investors = Investor::with(['investmentDetails', 'publicLinks', 'previousInvestments'])->get();

        // Check if the user is subscribed
        $subscriber = Subscriber::where('user_id', $userId)->first();

        // Pass data to the view
        return view('dashboards.banker', compact('investees', 'investors', 'subscriber'));
    }
}
