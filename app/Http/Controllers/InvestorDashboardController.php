<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Subscriber;
use App\Models\SectorDetail;
use App\Models\LocationDetail;
use App\Models\SubscriptionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\UserAccess;
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
   

    $userId = auth()->id(); // cleaner and safe
    $user = \App\Models\User::find($userId); // Get fresh data from DB

    if (!$user) {
        return redirect()->route('login')->withErrors('User not found.');
    }

    $formed_filled = $user->form_filled;
    $category_id = $user->category_id;
    // log the user ID and category ID
    \Log::info('User ID: ' . $userId . ', Category ID: ' . $category_id);
    // Check if the user has filled the form based on their category
    \Log::info('Form filled status: ' . $formed_filled);
    if ($formed_filled == 0) {
        switch ($category_id) {
            case 1:
                return redirect()->route('form.investee');
            case 2:
                return redirect()->route('form.investor');
            case 3:
                return redirect()->route('form.banker');
            case 4:
                return redirect()->route('form.other');
        }
    }
       $subscriber = Subscriber::where('user_id',$userId)->first();
       $investeesQuery = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource']);
       $sectors = SectorDetail::all();
       $locations =LocationDetail::all();

    //    if($subscriber && $subscriber->is_subscribed){
    //         $investees = $investeesQuery->limit(10)->get();
    //    }
    //    else
    //    {
    //         $investees = $investeesQuery->limit(3)->get();
    //    }

        if($subscriber && $subscriber->isSubscribed==1){
            $subscriptionRequestData = SubscriptionRequest::where('user_id', $userId)->first();
            if($subscriptionRequestData && $subscriptionRequestData->status=='approved'){
                if($subscriptionRequestData->status=='approved'){
                    $count = $subscriptionRequestData->no_of_data;
                    if($category_id== '3' || $category_id=='4'){

                        $halfcount = $count%2;
                        if($halfcount==0){
                            $count = $count/2;
                        }
                        else{
                            $count = ($count/2)-0.5;
                        }
                    }
                    $investees = $investeesQuery->limit($count)->get();
                }
                else{
                    $investees = $investeesQuery->limit(3)->get();
                }
            }
            else{
                $investees = $investeesQuery->limit(3)->get();
            }    
        }
        else{
            $investees =  $investeesQuery->limit(3)->get();
        }
       return view('dashboards.investordashboard',compact('subscriber','investees','sectors','locations'));
   }
  public function search(Request $request) 
{
    $userId = auth()->user()->id;
    $category_id = auth()->user()->category_id;
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Filter inputs
    $address = $request->input('location', []);
    $nature_of_business = $request->input('nature_of_business', []);
    $incorporated_in = $request->input('incorporated_in', null);
    $incorporated_in = is_array($incorporated_in) && count($incorporated_in) > 0 ? (int) $incorporated_in[0] : null;
    $fund_usage = $request->input('fund_usage', null);
    $searchbox = $request->input('searchBox', []);

    // Determine access limit
    $limit = 3; // default
    $subscription_request = SubscriptionRequest::where('user_id', $userId)->first();

    if ($subscriber && $subscriber->is_subscribed && $subscription_request && $subscription_request->status == 'approved') {
        $limit = $subscription_request->no_of_data;

        if ($category_id == '3' || $category_id == '4') {
            $halfcount = $limit % 2;
            if ($halfcount == 0) {
                $limit = $limit / 2;
            } else {
                $limit = ($limit / 2) - 0.5;
            }
        }
    } else {
        $limit = 3; // default limit for non-subscribers
    }

    // ✅ Fetch ALL companies (not limited to $companyids)
    $companiesQuery = Company::with([
        'user',
        'concernedPerson',
        'founders',
        'fundRequirements',
        'previousRounds',
        'otherLinks',
        'attachments',
        'referralSource'
    ])->orderBy('id');

    // Fetch all first (or optionally ->take($limit) if you want to restrict default visible count)
    $companies = $companiesQuery->get();

    // Apply filtering
    $filtered = $companies->filter(function ($company) use ($address, $nature_of_business, $incorporated_in, $fund_usage, $searchbox) {
        // Match searchbox
        if (!empty($searchbox)) {
            $searchStr = strtolower($searchbox);
            $match = str_contains(strtolower($company->company_name), $searchStr)
                || str_contains(strtolower($company->address), $searchStr)
                || str_contains(strtolower($company->nature_of_business), $searchStr);

            if (!$match) return false;
        }

        // Match address
        // if (!empty($address) && !in_array($company->address, $address)) {
        //     return false;
        // }
        if (!empty($address)) {
            $found = collect($address)->contains(function ($loc) use ($company) {
                return str_contains(strtolower($company->address), strtolower($loc));
            });
            if (!$found) return false;
        }


        // Match nature_of_business
        if (!empty($nature_of_business) && !in_array($company->nature_of_business, $nature_of_business)) {
            return false;
        }

        // Match incorporation year
        if (!empty($incorporated_in) && (int) $company->incorporated_in !== (int) $incorporated_in) {
            return false;
        }

        // Match fund usage
        if (!empty($fund_usage)) {
            $fundUsageStr = is_array($fund_usage) ? implode(' ', $fund_usage) : $fund_usage;

            $hasUsage = $company->fundRequirements->contains(function ($fr) use ($fundUsageStr) {
                $usage = is_array($fr->usage) ? implode(' ', $fr->usage) : (string) $fr->usage;
                return str_contains(strtolower($usage), strtolower($fundUsageStr));
            });

            if (!$hasUsage) return false;
        }

        return true;
    });

    // ✅ Fetch approved access list (for checking if user has access)
    $userAccess = UserAccess::where('user_id', $userId)
        ->where('status', 'approved')
        ->pluck('company_id')
        ->toArray();

    return view('partials.investee_list', [
        'investees' => $filtered,
        'subscriber' => $subscriber,
        'userAccess' => $userAccess
    ])->render();
}

    // public function search(Request $request)
    // {
    //     $userId = auth()->user()->id;
    //     $category_id = auth()->user()->category_id;
    //     $subscriber = Subscriber::where('user_id', $userId)->first();
    
    //     $address = $request->input('location', []);
    //     $nature_of_business = $request->input('nature_of_business', []);
    //     $incorporated_in = $request->input('incorporated_in', null);
    //     // $incorporated_in = is_array($incorporated_in) ? $incorporated_in[0] : $incorporated_in;
    //     $incorporated_in = is_array($incorporated_in) && count($incorporated_in) > 0 ? (int) $incorporated_in[0] : null;
    //     $fund_usage = $request->input('fund_usage', null);
    //     $searchbox = $request->input('searchBox', []);
        

    //     // dd($request->input('incorporated_in'), gettype($request->input('incorporated_in')));


    //     $limit = 3; // default
    //     $subscription_request = SubscriptionRequest::where('user_id', $userId)->first();
    //     if ($subscriber && $subscriber->is_subscribed && $subscription_request && $subscription_request->status == 'approved') {
    //         $limit = $subscription_request->no_of_data;
        
    //     if($category_id== '3' || $category_id=='4'){

    //         $halfcount = $limit%2;
    //         if($halfcount==0){
    //             $limit = $limit/2;
    //         }
    //         else{
    //             $limit = ($limit/2)-0.5;
    //         }
    //     }
    //     }
    //     else {
    //         $limit = 3; // default limit for non-subscribers
    //     }
    //     $companyids = DB::table('user_accesses')->where('user_id', $userId)->pluck('company_id')->toArray();

    //     if (!is_array($companyids) || empty($companyids)) {
    //         // If not an array or empty, return empty result early
    //         return view('partials.investee_list', [
    //         'investees' => collect(),
    //         'subscriber' => $subscriber
    //         ])->render();
    //     }
    //     //check $companyids is array and not empty
    //     // 1. Get the first N records only
    //     // $limitedCompanies = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])
    //     //     ->orderBy('id') // make sure the order is deterministic
    //     //     ->take($limit)
    //     //     ->get();
    //      $limitedCompanies = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])
    //         ->whereIn('id', $companyids)
    //         ->orderBy('id') // make sure the order is deterministic
    //         ->get();
    
    //     // Apply filtering in the collection
    //     $filtered = $limitedCompanies->filter(function ($company) use ($address, $nature_of_business, $incorporated_in, $fund_usage, $searchbox) {
    //         // Match searchbox
    //         if (!empty($searchbox)) {
    //             $match = false;
    //             $searchStr = strtolower($searchbox);
    //             if (str_contains(strtolower($company->company_name), $searchStr) ||
    //                 str_contains(strtolower($company->address), $searchStr) ||
    //                 str_contains(strtolower($company->nature_of_business), $searchStr)) {
    //                 $match = true;
    //             }
    //             if (!$match) return false;
    //         }

    //         // Match address
    //         if (!empty($address) && !in_array($company->address, $address)) {
    //             return false;
    //         }

    //         // Match nature_of_business
    //         if (!empty($nature_of_business) && !in_array($company->nature_of_business, $nature_of_business)) {
    //             return false;
    //         }

    //         // Match incorporation year
    //         if (!empty($incorporated_in) && (int) $company->incorporated_in !== (int) $incorporated_in) {
    //             return false;
    //         }

    //          // Match fund usage
    //         // Match fund usage
    //         // Match fund usage
    //         if (!empty($fund_usage)) {
    //             // Ensure $fund_usage is a string
    //             $fundUsageStr = is_array($fund_usage) ? implode(' ', $fund_usage) : $fund_usage;

    //             $hasUsage = $company->fundRequirements->contains(function ($fr) use ($fundUsageStr) {
    //                 // Handle $fr->usage being array or string
    //                 if (is_array($fr->usage)) {
    //                     $usage = implode(' ', $fr->usage);
    //                 } elseif (is_string($fr->usage)) {
    //                     $usage = $fr->usage;
    //                 } else {
    //                     return false;
    //                 }

    //                 return strtolower($usage) === strtolower($fundUsageStr);
    //             });

    //             if (!$hasUsage) return false;
    //         }


    //         return true;
    //     });

    
    //     return view('partials.investee_list', [
    //         'investees' => $filtered,
    //         'subscriber' => $subscriber
    //     ])->render();
    // }
    
    
    
    
    

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
