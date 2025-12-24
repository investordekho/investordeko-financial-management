<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\SubscriptionRequest;
use App\Models\Payment_detail;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

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

        $investorsQuery = Investor::with(['contactDetails','publicLinks', 'previousInvestments', 'investmentDetails','referrals','guidanceNeeds','public_links','investorAddresses']);
        // Apply limits based on subscription status
        if ($subscriber && $subscriber->is_subscribed) {
            // Fetch 10 results for subscribed users
            $investors = $investorsQuery->take(10)->get();
        } else {
            // Fetch 3 results for unsubscribed users
            $investors = $investorsQuery->take(3)->get();
        }

        return view('dashboards.investee', compact('investors', 'subscriber'));
    }


   public function index2()
{
    $userId = auth()->user()->id;
    $category_id = auth()->user()->category_id;
    $subscriber = Subscriber::where('user_id', $userId)->first();
    $formed_filled = auth()->user()->form_filled;

    if($formed_filled==0 && $category_id == 1){
        return redirect()->route('form.investee');
    }
    if($formed_filled == 0 && $category_id == 2){
        return redirect()->route('form.investor');
    }
    if($formed_filled == 0 && $category_id == 3){
        return redirect()->route('form.banker');
    }
    if($formed_filled == 0 && $category_id == 4){
        return redirect()->route('form.other');
    }
        $investorsQuery = Investor::with([
        'contactDetails', 'publicLinks', 'previousInvestments',
        'investmentDetails', 'referrals', 'guidanceNeeds', 'investorAddresses'
    ]);

    // Fetch IDs from UserAccess table first
    $userAccessIds = UserAccess::where('user_id', $userId)
                    ->where('status', 'approved')
                    ->pluck('investor_id')
                    ->toArray();

    // Log::info('User Access IDs:', $userAccessIds);

    // Apply whereIn using the array
    $investorsQuery->whereIn('id', $userAccessIds);

    $investorsData = $investorsQuery->get();
    // Log::info('Investors fetched:', $investorsData->toArray());

        $subscriber_data = SubscriptionRequest::where('user_id', $userId)->first();
        if($subscriber && $subscriber->is_subscribed==1)
            {
                if($subscriber_data && $subscriber_data->status){
                    
                    if($subscriber_data->status== 'approved'){
                        $count = $subscriber_data->no_of_data;
                        if($category_id== '3' || $category_id=='4'){

                            $halfcount = $count%2;
                            if($halfcount==0){
                                $count = $count/2;
                            }
                            else{
                                $count = ($count/2)+0.5;
                            }
                            $investors = $investorsQuery->take($count)->get();
                        }
                         else{
                            //take only those investors whose id is in the useraccess table
                            $investors = $investorsQuery->get();
                         }
                    }
                    else{
                        $investors = $investorsQuery->take(3)->get();
                    }
                
                }
                else{
                        $investors = $investorsQuery->take(3)->get();
                }
            }
        else{
                $investors = $investorsQuery->take(3)->get();
            }

            $userAccess = UserAccess::where('user_id', $userId)
                ->where('status', 'approved')
                ->pluck('investor_id') // only IDs of approved investors
                ->toArray();

    // return view('partials.investor_list', ['investors' => $filteredInvestors, 'subscriber' => $subscriber, 'userAccess' => $userAccess]);

    return view('dashboards.investee', compact('investors', 'subscriber', 'userAccess'));
}

public function index(Request $request)
{
    $userId = auth()->user()->id;
    $category_id = auth()->user()->category_id;
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Get the first 10 (or 3 if not subscribed) investors from the database
    
    // $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
    
    
    $count=0;
    $subscriber_data = SubscriptionRequest::where('user_id', $userId)->first();
    if($subscriber && $subscriber->is_subscribed==1)
        {
            if($subscriber_data && $subscriber_data->status){
                
                if($subscriber_data->status== 'approved'){
                    $count = $subscriber_data->no_of_data;
                    if($category_id== '3' || $category_id=='4'){

                        $halfcount = $count%2;
                        if($halfcount==0){
                            $count = $count/2;
                        }
                        else{
                            $count = ($count/2)+0.5;
                        }
                    }
                    // $investors = $investorsQuery->take($count)->get(); 
                }
                else{
                    $count=3;
                    // $investors = $investorsQuery->take(3)->get();
                }
            
            }
            else{
                $count=3;
                    // $investors = $investorsQuery->take(3)->get();
            }
        }
    else{
            $count=3;
            // $investors = $investorsQuery->take(3)->get();
        }

    // $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
    $limit = $count;
    // Fetch limited investors first
    // $investorsQuery = Investor::query()
    //     ->with('investmentDetails')
    //     ->select('investors.*')
    //     ->distinct()
    //     ->take($limit);

       $investorsQuery = Investor::query()
        ->with('investmentDetails')
        ->select('investors.*')
        ->distinct();
        
    // Get the first 10 (or 3) investors before applying search filters
    $limitedInvestors = $investorsQuery->get();

    // Now filter within these investors
    $filteredInvestors = $limitedInvestors->filter(function ($investor) use ($request) {
        $match = true;

        // Filter by sector
        $sectors = $request->input('sector', []);
        if (!empty($sectors)) {
            $match = $match && collect($sectors)->contains(function ($sector) use ($investor) {
                return str_contains($investor->sectors_preferred, $sector);
            });
        }

        // Filter by location
        $locations = $request->input('location', []);
        if (!empty($locations)) {
            $match = $match && collect($locations)->contains(function ($location) use ($investor) {
                return str_contains($investor->address, $location);
            });
        }

        // Filter by investment size, tenure, and type (from investmentDetails)
        $investmentDetails = $investor->investmentDetails;

        if ($investmentDetails) {
            // $investmentSizes = $request->input('investment_size', []);
            // if (!empty($investmentSizes)) {
            //     $match = $match && collect($investmentSizes)->contains(function ($size) use ($investmentDetails) {
            //         // Normalize the investment size to handle different formats
            //         $size = strtolower(trim($size));
            //         // Check if the investment size contains the specified size

            //         return str_contains($investmentDetails->investment_size, $size);
            //     }); 
            // }

      $investmentSizes = $request->input('investment_size', []);

        if (!empty($investmentSizes)) {
            // Log::info('Selected Investment Sizes from request:', $investmentSizes);

            $dbSize = $this->parseInvestmentSizeToNumber($investmentDetails->investment_size ?? '');

            // Log::info('Parsed investment size from DB:', ['input' => $investmentDetails->investment_size, 'numeric' => $dbSize]);

            $matchesAny = collect($investmentSizes)->contains(function ($range) use ($dbSize) {
                if ($range === '<1000000') {
                    return $dbSize < 1000000;
                } elseif ($range === '1000000-5000000') {
                    return $dbSize >= 1000000 && $dbSize <= 5000000;
                } elseif ($range === '5000000-10000000') {
                    return $dbSize > 5000000 && $dbSize <= 10000000;
                } elseif ($range === '>10000000') {
                    return $dbSize > 10000000;
                }
                return false;
            });

            $match = $match && $matchesAny;

            // Log::info('Matching result:', ['match' => $match]);
        }




                    







             // ✅ Filter by investment tenure (Corrected)
             $investmentTenures = $request->input('investment_tenure', []);
             $normalizedTenure = $this->normalizeTenure($investmentDetails->investment_tenure);
 
             if (!empty($investmentTenures)) {
                 $match = $match && collect($investmentTenures)->contains(fn($selectedTenure) => $this->isOverlappingTenure($selectedTenure, $normalizedTenure));
             }


            
            $investorTypes = $request->input('investor_type', []);
            if (!empty($investorTypes) && $investmentDetails) {
                $match = $match && collect($investorTypes)->contains(function ($type) use ($investmentDetails) {
                    return str_contains($investmentDetails->investor_type, $type);
                });
            }
            
            

        }

        return $match;
    });

    // Convert collection back to an array for sorting
    $filteredInvestors = $filteredInvestors->values();

    // Apply sorting
    $sort = $request->input('sort', null);
    if ($sort == 'Investor Name (Ascending)') {
        $filteredInvestors = $filteredInvestors->sortBy('investor_name')->values();
    } elseif ($sort == 'Investor Name (Descending)') {
        $filteredInvestors = $filteredInvestors->sortByDesc('investor_name')->values();
    } elseif ($sort == 'Investment Size (Low to High)') {
        $filteredInvestors = $filteredInvestors->sortBy(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
    } elseif ($sort == 'Investment Size (High to Low)') {
        $filteredInvestors = $filteredInvestors->sortByDesc(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
    }

   if (!Schema::hasTable('user_accesses')) {
    $userAccess = [];
} else {
    $userAccess = UserAccess::where('user_id', $userId)
        ->where('status', 'approved')
        ->pluck('investor_id')
        ->toArray();
}


                //save data in session investors ,subscriber and useraccess
                // session(['investors' => $filteredInvestors]);
                // session(['subscriber' => $subscriber]);
                // session(['userAccess' => $userAccess]);
                //lets just store investors id in session
               
                $investorIds = $filteredInvestors->pluck('id')->toArray();
                $userCanAccessNew = array_values(array_diff($investorIds, $userAccess));
                $userAccess = array_values($userAccess);
                log::info('User Access IDs:', $userAccess);
                log::info('User Can Access New Investors1111111111111111111111111111111111111111111111111111111111111:', $userCanAccessNew);
                session()->forget(['investor_ids', 'userAccess', 'subscriber', 'max_investors_can_subscribe']);
                session(['investor_ids' => $investorIds]);
                session(['subscriber' => $subscriber]);
                session(['userAccess' => $userAccess]);
                session(['max_investors_can_subscribe' => $userCanAccessNew]);
                session(['max_investees_can_subscribe' => 0]); // Initialize to 0
                log::info('Investor IDs stored in session:', $investorIds);
                log::info('index method called from investee dashboard--investeedashboardcontroller');
    // Show subscription message if there are investors not in userAccess   
    $showSubscribeMessage = false;
     
    return view('dashboards.investee', ['investors' => $filteredInvestors, 'subscriber' => $subscriber, 'userAccess' => $userAccess, 'showSubscribeMessage' => $showSubscribeMessage]);
}



public function search(Request $request)
{
    $userId = auth()->user()->id;
    $category_id = auth()->user()->category_id;
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Get the first 10 (or 3 if not subscribed) investors from the database
    
    // $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
    
    
    $count=0;
    $subscriber_data = SubscriptionRequest::where('user_id', $userId)->first();
    if($subscriber && $subscriber->is_subscribed==1)
        {
            if($subscriber_data && $subscriber_data->status){
                
                if($subscriber_data->status== 'approved'){
                    $count = $subscriber_data->no_of_data;
                    if($category_id== '3' || $category_id=='4'){

                        $halfcount = $count%2;
                        if($halfcount==0){
                            $count = $count/2;
                        }
                        else{
                            $count = ($count/2)+0.5;
                        }
                    }
                    // $investors = $investorsQuery->take($count)->get(); 
                }
                else{
                    $count=3;
                    // $investors = $investorsQuery->take(3)->get();
                }
            
            }
            else{
                $count=3;
                    // $investors = $investorsQuery->take(3)->get();
            }
        }
    else{
            $count=3;
            // $investors = $investorsQuery->take(3)->get();
        }

    // $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
    $limit = $count;
    // Fetch limited investors first
    // $investorsQuery = Investor::query()
    //     ->with('investmentDetails')
    //     ->select('investors.*')
    //     ->distinct()
    //     ->take($limit);

       $investorsQuery = Investor::query()
        ->with('investmentDetails')
        ->select('investors.*')
        ->distinct();
        
    // Get the first 10 (or 3) investors before applying search filters
    $limitedInvestors = $investorsQuery->get();

    // Now filter within these investors
    $filteredInvestors = $limitedInvestors->filter(function ($investor) use ($request) {
        $match = true;

        // Filter by sector
        $sectors = $request->input('sector', []);
        if (!empty($sectors)) {
            $match = $match && collect($sectors)->contains(function ($sector) use ($investor) {
                return str_contains($investor->sectors_preferred, $sector);
            });
        }

        // Filter by location
        $locations = $request->input('location', []);
        if (!empty($locations)) {
            $match = $match && collect($locations)->contains(function ($location) use ($investor) {
                return str_contains($investor->address, $location);
            });
        }

        // Filter by investment size, tenure, and type (from investmentDetails)
        $investmentDetails = $investor->investmentDetails;

        if ($investmentDetails) {
            // $investmentSizes = $request->input('investment_size', []);
            // if (!empty($investmentSizes)) {
            //     $match = $match && collect($investmentSizes)->contains(function ($size) use ($investmentDetails) {
            //         // Normalize the investment size to handle different formats
            //         $size = strtolower(trim($size));
            //         // Check if the investment size contains the specified size

            //         return str_contains($investmentDetails->investment_size, $size);
            //     }); 
            // }

      $investmentSizes = $request->input('investment_size', []);

        if (!empty($investmentSizes)) {
            // Log::info('Selected Investment Sizes from request:', $investmentSizes);

            $dbSize = $this->parseInvestmentSizeToNumber($investmentDetails->investment_size ?? '');

            // Log::info('Parsed investment size from DB:', ['input' => $investmentDetails->investment_size, 'numeric' => $dbSize]);

            $matchesAny = collect($investmentSizes)->contains(function ($range) use ($dbSize) {
                if ($range === '<1000000') {
                    return $dbSize < 1000000;
                } elseif ($range === '1000000-5000000') {
                    return $dbSize >= 1000000 && $dbSize <= 5000000;
                } elseif ($range === '5000000-10000000') {
                    return $dbSize > 5000000 && $dbSize <= 10000000;
                } elseif ($range === '>10000000') {
                    return $dbSize > 10000000;
                }
                return false;
            });

            $match = $match && $matchesAny;

            // Log::info('Matching result:', ['match' => $match]);
        }




                    







             // ✅ Filter by investment tenure (Corrected)
             $investmentTenures = $request->input('investment_tenure', []);
             $normalizedTenure = $this->normalizeTenure($investmentDetails->investment_tenure);
 
             if (!empty($investmentTenures)) {
                 $match = $match && collect($investmentTenures)->contains(fn($selectedTenure) => $this->isOverlappingTenure($selectedTenure, $normalizedTenure));
             }


            
            $investorTypes = $request->input('investor_type', []);
            if (!empty($investorTypes) && $investmentDetails) {
                $match = $match && collect($investorTypes)->contains(function ($type) use ($investmentDetails) {
                    return str_contains($investmentDetails->investor_type, $type);
                });
            }
            
            

        }

        return $match;
    });

    // Convert collection back to an array for sorting
    $filteredInvestors = $filteredInvestors->values();

    // Apply sorting
    $sort = $request->input('sort', null);
    if ($sort == 'Investor Name (Ascending)') {
        $filteredInvestors = $filteredInvestors->sortBy('investor_name')->values();
    } elseif ($sort == 'Investor Name (Descending)') {
        $filteredInvestors = $filteredInvestors->sortByDesc('investor_name')->values();
    } elseif ($sort == 'Investment Size (Low to High)') {
        $filteredInvestors = $filteredInvestors->sortBy(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
    } elseif ($sort == 'Investment Size (High to Low)') {
        $filteredInvestors = $filteredInvestors->sortByDesc(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
    }

    $userAccess = UserAccess::where('user_id', $userId)
                ->where('status', 'approved')
                ->pluck('investor_id')
                ->toArray();

    $investorIds = $filteredInvestors->pluck('id')->toArray();
     $userCanAccessNew = array_diff($investorIds, $userAccess);
    log::info('User Can Access New Investors 3', $userCanAccessNew);
     session()->forget(['investor_ids', 'userAccess', 'subscriber', 'max_investors_can_subscribe']);
               
    session(['investor_ids' => $investorIds]);
    session(['subscriber' => $subscriber]);
    session(['userAccess' => $userAccess]);
    session(['max_investors_can_subscribe' => $userCanAccessNew]);
    session(['max_investees_can_subscribe' => 0]); // Initialize to 0
    
    // Show subscription message if there are investors not in userAccess
    $showSubscribeMessage = (count($investorIds) > 0 && 
                            count(array_diff($investorIds, $userAccess)) > 0 && $request->hasAny(['sector', 'location', 'investment_size', 'investment_tenure', 'investor_type']));

    log::info('Investor IDs stored in session:', $investorIds);
    log::info('search method called from investee dashboard--investeedaashboardcontroller');                            

    return view('partials.investor_list', [
        'investors' => $filteredInvestors, 
        'subscriber' => $subscriber, 
        'userAccess' => $userAccess,
        'showSubscribeMessage' => $showSubscribeMessage
    ]);
}

// Add this helper function to your controller:
function parseInvestmentSizeToNumber($value)
{
    $value = strtoupper(str_replace(['₹', ' ', ','], '', $value));

    if (str_ends_with($value, 'M')) {
        return floatval(rtrim($value, 'M')) * 1000000;
    } elseif (str_ends_with($value, 'K')) {
        return floatval(rtrim($value, 'K')) * 1000;
    } elseif (is_numeric($value)) {
        return floatval($value);
    }

    return 0;
}











function categorizeInvestmentTenure($tenure)
{
    $tenure = normalizeInvestmentTenure($tenure);

    if (str_contains($tenure, 'not specified') || str_contains($tenure, 'impact investing')) {
        return 'Not Specified';
    }

    if (preg_match('/(\d+)y/', $tenure, $matches)) {
        $years = (int)$matches[1];

        if ($years < 1) {
            return 'Less than 1 year';
        } elseif ($years >= 1 && $years <= 3) {
            return '1-3 years';
        } elseif ($years >= 3 && $years <= 5) {
            return '3-5 years';
        } else {
            return 'More than 5 years';
        }
    }

    return 'Not Specified';
}

function normalizeTenure($tenure)
{
    if (!$tenure || stripos($tenure, 'not specified') !== false) {
        return 'Not Specified';
    }

    $tenure = strtolower(trim($tenure));
    $tenure = str_replace(['years', 'year'], 'y', $tenure);
    $tenure = str_replace(['months', 'month'], 'm', $tenure);
    $tenure = str_replace(['–', ' to '], '-', $tenure); // Normalize ranges

    // Extract numbers
    preg_match('/(\d+)y/', $tenure, $yearMatch);
    preg_match('/(\d+)m/', $tenure, $monthMatch);

    $y = isset($yearMatch[1]) ? (int) $yearMatch[1] : 0;
    $m = isset($monthMatch[1]) ? (int) $monthMatch[1] : 0;

    // ✅ Convert months to years properly
    $totalYears = $y + ($m / 12); 

    // ✅ Correct tenure categorization
    if ($totalYears < 1) return "0-1 years"; 
    if ($totalYears >= 1 && $totalYears < 3) return "1-3 years";
    if ($totalYears >= 3 && $totalYears < 5) return "3-5 years";
    return "More than 5 years";
}

function isOverlappingTenure($selected, $normalized) {
    $ranges = [
        "0-1 years" => [0, 1],
        "1-3 years" => [1, 3],
        "3-5 years" => [3, 5],
        "More than 5 years" => [5, PHP_INT_MAX],
    ];

    if (!isset($ranges[$selected]) || !isset($ranges[$normalized])) {
        return false;
    }

    [$selMin, $selMax] = $ranges[$selected];
    [$normMin, $normMax] = $ranges[$normalized];

    $overlapping = ($selMin < $normMax) && ($normMin < $selMax); // Overlapping check

    // 🔹 Debug Output
    // if ($overlapping) {
    //     \Log::info("Overlapping Tenure Found: {$selected} and {$normalized}");
    // } else {
    //     \Log::info("No Overlap: {$selected} and {$normalized}");
    // }

    return $overlapping;
}






function toNumber(string $value): float
{
    $value = str_replace(['₹', ',', ' '], '', strtoupper($value));

    if (str_ends_with($value, 'M')) {
        return (float) $value * 1000000;
    }

    return (float) $value; // fallback if no M
}


 function investeedetaildashboard($id)
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