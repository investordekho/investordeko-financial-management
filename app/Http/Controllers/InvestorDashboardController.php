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

       $category_id = auth()->user()->category_id;

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
    /**
     * Search function for filtering investees.
     */
    // public function search1(Request $request)
    // {
    //     // Get the logged-in user's ID
    //     $userId = auth()->user()->id;

    //     // Check if the user is subscribed
    //     $subscriber = Subscriber::where('user_id', $userId)->first();

    //     // Retrieve the search criteria from the request
    //     $address = $request->input('location', []); // The field name in the form is 'location'
    //     $nature_of_business = $request->input('nature_of_business', []); // Field for sector/nature of business
    //     $incorporated_in = $request->input('incorporated_in', null);
    //     $fund_usage = $request->input('fund_usage', null);
    //     $searchbox = $request->input('searchBox',[]);

    //     // Start building the query
    //     $query = Company::query();
    //     $subscription_request = SubscriptionRequest::where('user_id', $userId)->first();
    //     if($subscriber && $subscriber->is_subscribed){
    //         if($subscription_request && $subscription_request->status == 'approved'){
    //             $count = $subscription_request->no_of_data;
    //             $query->limit($count);
    //         }
    //         else{
    //             $query->limit(3);
    //         }
    //     }
    //     else{
    //         $query->limit(3);
    //     }

    //     // Apply searchbox filter
    //     if (!empty($searchbox)){
    //         $query->where(function ($q) use ($searchbox){
    //             $q->where('company_name', 'LIKE', '%' . $searchbox . '%')
    //                 ->orwhere('address', 'LIKE', '%'. $searchbox . '%')
    //                 ->orwhere('nature_of_business' , 'LIKE' , '%'. $searchbox . '%');
    //         });
    //     }

    //     // Apply filters
    //     if (!empty($address)) {
    //         $query->whereIn('address', $address); // Match the location with address in the companies table
    //     }

    //     if (!empty($nature_of_business)) {
    //         $query->whereIn('nature_of_business', $nature_of_business); // Filter by sector/nature of business
    //     }

    //     if (!empty($incorporated_in)) {
    //         $query->where('incorporated_in', $incorporated_in); // Filter by incorporation year
    //     }

    //     if (!empty($fund_usage)) {
    //         $query->whereHas('fundRequirements', function ($q) use ($fund_usage) {
    //             $q->where('usage', $fund_usage); // Filter by usage of funds
    //         }); 
    //     }

    //     // Fetch the filtered results
    //     $investees = $query->with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])->get();

    //     return view('partials.investee_list', compact('investees', 'subscriber'))->render();
    // }


    // public function search(Request $request)
    // {
    //     $userId = auth()->user()->id;
    
    //     $subscriber = Subscriber::where('user_id', $userId)->first();
    
    //     $address = $request->input('location', []);
    //     $nature_of_business = $request->input('nature_of_business', []);
    //     $incorporated_in = $request->input('incorporated_in', null);
    //     $fund_usage = $request->input('fund_usage', null);
    //     $searchbox = $request->input('searchBox', []);
    
    //     $limit = 3; // default
    //     $subscription_request = SubscriptionRequest::where('user_id', $userId)->first();
    //     if ($subscriber && $subscriber->is_subscribed && $subscription_request && $subscription_request->status == 'approved') {
    //         $limit = $subscription_request->no_of_data;
    //     }
    
    //     // 1. Get the first N records only
    //     $limitedCompanies = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])
    //         ->orderBy('id') // make sure the order is deterministic
    //         ->take($limit)
    //         ->get();
    
    //     // 2. Apply filtering in PHP collection
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
    //         if (!empty($incorporated_in) && $company->incorporated_in != $incorporated_in) {
    //             return false;
    //         }
    
    //         // Match fund usage
    //         if (!empty($fund_usage)) {
    //             // Ensure fundRequirements relationship is loaded
    //             $hasUsage = $company->fundRequirements->contains(function ($fr) use ($fund_usage) {
    //                 return strtolower($fr->usage) === strtolower($fund_usage); // Ensure case-insensitive matching
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
    public function search(Request $request)
    {
        $userId = auth()->user()->id;
        $category_id = auth()->user()->category_id;
        $subscriber = Subscriber::where('user_id', $userId)->first();
    
        $address = $request->input('location', []);
        $nature_of_business = $request->input('nature_of_business', []);
        $incorporated_in = $request->input('incorporated_in', null);
        // $incorporated_in = is_array($incorporated_in) ? $incorporated_in[0] : $incorporated_in;
        $incorporated_in = is_array($incorporated_in) && count($incorporated_in) > 0 ? (int) $incorporated_in[0] : null;
        $fund_usage = $request->input('fund_usage', null);
        $searchbox = $request->input('searchBox', []);
        

        // dd($request->input('incorporated_in'), gettype($request->input('incorporated_in')));


        $limit = 3; // default
        $subscription_request = SubscriptionRequest::where('user_id', $userId)->first();
        if ($subscriber && $subscriber->is_subscribed && $subscription_request && $subscription_request->status == 'approved') {
            $limit = $subscription_request->no_of_data;
        }
        if($category_id== '3' || $category_id=='4'){

            $halfcount = $limit%2;
            if($halfcount==0){
                $limit = $limit/2;
            }
            else{
                $limit = ($limit/2)-0.5;
            }
        }
        // 1. Get the first N records only
        $limitedCompanies = Company::with(['user','concernedPerson','founders','fundRequirements','previousRounds','otherLinks','attachments','referralSource'])
            ->orderBy('id') // make sure the order is deterministic
            ->take($limit)
            ->get();
    
        // Apply filtering in the collection
        $filtered = $limitedCompanies->filter(function ($company) use ($address, $nature_of_business, $incorporated_in, $fund_usage, $searchbox) {
            // Match searchbox
            if (!empty($searchbox)) {
                $match = false;
                $searchStr = strtolower($searchbox);
                if (str_contains(strtolower($company->company_name), $searchStr) ||
                    str_contains(strtolower($company->address), $searchStr) ||
                    str_contains(strtolower($company->nature_of_business), $searchStr)) {
                    $match = true;
                }
                if (!$match) return false;
            }

            // Match address
            if (!empty($address) && !in_array($company->address, $address)) {
                return false;
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
            // Match fund usage
            // Match fund usage
            if (!empty($fund_usage)) {
                // Ensure $fund_usage is a string
                $fundUsageStr = is_array($fund_usage) ? implode(' ', $fund_usage) : $fund_usage;

                $hasUsage = $company->fundRequirements->contains(function ($fr) use ($fundUsageStr) {
                    // Handle $fr->usage being array or string
                    if (is_array($fr->usage)) {
                        $usage = implode(' ', $fr->usage);
                    } elseif (is_string($fr->usage)) {
                        $usage = $fr->usage;
                    } else {
                        return false;
                    }

                    return strtolower($usage) === strtolower($fundUsageStr);
                });

                if (!$hasUsage) return false;
            }


            return true;
        });

    
        return view('partials.investee_list', [
            'investees' => $filtered,
            'subscriber' => $subscriber
        ])->render();
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
