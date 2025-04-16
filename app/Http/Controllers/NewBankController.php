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

class NewBankController extends Controller
{
    public function searchinvestorforbanker(Request $request)
    {
        $userId = auth()->user()->id;
        $subscriber = Subscriber::where('user_id', $userId)->first();

        // Get the first 10 (or 3 if not subscribed) investors from the database
        $limit = $subscriber && $subscriber->is_subscribed ? 10 : 3;
        
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
                $investmentSizes = $request->input('investment_size', []);
                if (!empty($investmentSizes)) {
                    $match = $match && collect($investmentSizes)->contains(function ($size) use ($investmentDetails) {
                        return str_contains($investmentDetails->investment_size, $size);
                    });
                }

                // $investmentTenures = $request->input('investment_tenure', []);
                // if (!empty($investmentTenures)) {
                //     $match = $match && collect($investmentTenures)->contains(function ($tenure) use ($investmentDetails) {
                //         return str_contains($investmentDetails->investment_tenure, $tenure);
                //     });
                // }





                // ✅ Filter by investment tenure (Corrected)
                $investmentTenures = $request->input('investment_tenure', []);
                $normalizedTenure = $this->normalizeTenure($investmentDetails->investment_tenure);
    
                if (!empty($investmentTenures)) {
                    $match = $match && collect($investmentTenures)->contains(fn($selectedTenure) => $this->isOverlappingTenure($selectedTenure, $normalizedTenure));
                }




                // $investmentTenures = $request->input('investment_tenure', []);
                // $normalizedTenure = $this->normalizeTenure($investmentDetails->investment_tenure);

                // if (!empty($investmentTenures)) {
                //     $actualMatch = collect($investmentTenures)->contains(function ($selectedTenure) use ($normalizedTenure) {
                //         return $this->isOverlappingTenure($selectedTenure, $normalizedTenure);
                //     });

                //     // ✅ Ensure we print the final, updated value
                //     dd([
                //         'Selected Tenures' => $investmentTenures,
                //         'Database Tenure' => $investmentDetails->investment_tenure,
                //         'Normalized Tenure' => $normalizedTenure,
                //         'Matches?' => $actualMatch, // ✅ Should now be "true"
                //     ]);
                // }

                
                
                

                

            }

            return $match;
        });

        // Convert collection back to an array for sorting
        $filteredInvestors = $filteredInvestors->values();

        // Apply sorting
        $sort = $request->input('sort', null);
        if ($sort == 'A-Z') {
            $filteredInvestors = $filteredInvestors->sortBy('investor_name')->values();
        } elseif ($sort == 'Z-A') {
            $filteredInvestors = $filteredInvestors->sortByDesc('investor_name')->values();
        } elseif ($sort == 'investment_size_asc') {
            $filteredInvestors = $filteredInvestors->sortBy(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
        } elseif ($sort == 'investment_size_desc') {
            $filteredInvestors = $filteredInvestors->sortByDesc(fn($inv) => $inv->investmentDetails->investment_size ?? 0)->values();
        }

        return view('partials.investor_list', ['investors' => $filteredInvestors, 'subscriber' => $subscriber]);
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





    public function searchinvesteeforbanker(Request $request)
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





    public function returninvestorview()
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

        return view('dashboards.bankerinvestor', compact('investors', 'subscriber'));
    }

    public function returninvesteeview()
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
        return view('dashboards.bankerinvestee',compact('subscriber','investees','sectors','locations'));
    }
}
