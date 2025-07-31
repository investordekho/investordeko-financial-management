<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\SubscriptionRequest;
use App\Models\Payment_detail;
use Illuminate\Support\Facades\Log;

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
    public function index()
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
    // Fetch investors with related data
    $investorsQuery = Investor::with([
        'contactDetails', 'publicLinks', 'previousInvestments',
        'investmentDetails', 'referrals', 'guidanceNeeds', 'investorAddresses'
    ]);

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
                        $investors = $investorsQuery->take($count)->get(); 
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

    return view('dashboards.investee', compact('investors', 'subscriber'));
}


    /**
     * Search for investors based on filter criteria.
     */
//    public function search(Request $request)
// {
//     // Get the logged-in user's ID
//     $userId = auth()->user()->id;

//     // Check if the user is subscribed
//     $subscriber = Subscriber::where('user_id', $userId)->first();

//     // Start building the query with a join to investment_details table
//     $query = Investor::query()->with('investmentDetails');

//     $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
//     $investors = $query->select('investors.*')->distinct()->take($limit)->get();

//     // Filter based on sectors (match any sector using LIKE)
//     $sectors = $request->input('sector', []);
//     if (!empty($sectors)) {
//         $query->where(function ($q) use ($sectors) {
//             foreach ($sectors as $sector) {
//                 $q->orWhere('sectors_preferred', 'LIKE', '%' . $sector . '%');
//             }
//         });
//     }

//     // Filter based on location (address)
//     $locations = $request->input('location', []);
//     if (!empty($locations)) {
//         $query->where(function ($q) use ($locations) {
//             foreach ($locations as $location) {
//                 $q->orWhere('address', 'LIKE', '%' . $location . '%');
//             }
//         });
//     }

//     // Join with the investment_details table to filter based on investment size, tenure, and type
//     $query->join('investment_details', 'investment_details.investor_id', '=', 'investors.id');

//     // Filter based on investment size
//     $investmentSizes = $request->input('investment_size', []);
//     if (!empty($investmentSizes)) {
//         $query->where(function ($q) use ($investmentSizes) {
//             foreach ($investmentSizes as $size) {
//                 $q->orWhere('investment_details.investment_size', 'LIKE', '%' . $size . '%');
//             }
//         });
//     }

//     // Filter based on investment tenure
//     $investmentTenures = $request->input('investment_tenure', []);
//     if (!empty($investmentTenures)) {
//         $query->where(function ($q) use ($investmentTenures) {
//             foreach ($investmentTenures as $tenure) {
//                 $q->orWhere('investment_details.investment_tenure', 'LIKE', '%' . $tenure . '%');
//             }
//         });
//     }

//     // Filter based on investor type
//     $investorTypes = $request->input('investor_type', []);
//     if (!empty($investorTypes)) {
//         $query->where(function ($q) use ($investorTypes) {
//             foreach ($investorTypes as $type) {
//                 $q->orWhere('investment_details.investor_type', 'LIKE', '%' . $type . '%');
//             }
//         });
//     }

//     // Handle sorting
//     $sort = $request->input('sort', null);
//     if ($sort == 'A-Z') {
//         $query->orderBy('investor_name', 'asc');
//     } elseif ($sort == 'Z-A') {
//         $query->orderBy('investor_name', 'desc');
//     } elseif ($sort == 'investment_size_asc') {
//         $query->orderBy('investment_details.investment_size', 'asc');
//     } elseif ($sort == 'investment_size_desc') {
//         $query->orderBy('investment_details.investment_size', 'desc');
//     }

//     // Determine the number of results based on subscription status
//     // Return a partial view containing only the investor list and subscriber data
//     return view('partials.investor_list', compact('investors', 'subscriber'));
// }



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
    $investorsQuery = Investor::query()
        ->with('investmentDetails')
        ->select('investors.*')
        ->distinct()
        ->take($limit);

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
    Log::info('Selected Investment Sizes from request:', $investmentSizes);

    $dbSize = $this->parseInvestmentSizeToNumber($investmentDetails->investment_size ?? '');

    Log::info('Parsed investment size from DB:', ['input' => $investmentDetails->investment_size, 'numeric' => $dbSize]);

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

    Log::info('Matching result:', ['match' => $match]);
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

    return view('partials.investor_list', ['investors' => $filteredInvestors, 'subscriber' => $subscriber]);
}

// i want to fillter the investment size also add debugging logs to check the values falling through the filter in which the investment size is not matching and get finanl corrected values
// function categorizeInvestmentSize($size)
// {
//     $size = $this->toNumber($size);

//     if ($size < 1000000) {
//         return ['Less than ₹1M'];
//     } elseif ($size >= 1000000 && $size < 5000000) {
//         return ['₹1M - ₹5M'];
//     } elseif ($size >= 5000000 && $size < 10000000) {
//         return ['₹5M - ₹10M'];
//     } else {
//         return ['More than ₹10M'];
//     }
// }

// Add this helper function to your controller:
private function parseInvestmentSizeToNumber($value)
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
    if ($overlapping) {
        \Log::info("Overlapping Tenure Found: {$selected} and {$normalized}");
    } else {
        \Log::info("No Overlap: {$selected} and {$normalized}");
    }

    return $overlapping;
}






private function toNumber(string $value): float
{
    $value = str_replace(['₹', ',', ' '], '', strtoupper($value));

    if (str_ends_with($value, 'M')) {
        return (float) $value * 1000000;
    }

    return (float) $value; // fallback if no M
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
