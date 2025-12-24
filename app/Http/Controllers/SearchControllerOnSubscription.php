<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Subscriber;
use App\Models\SectorDetail;
use App\Models\LocationDetail;
use App\Models\SubscriptionRequest;
use Illuminate\Support\Str;
use App\Models\UserAccess;
use App\Models\Investor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchControllerOnSubscription extends Controller 
{
    public function search(Request $request)
{
    $userId = auth()->user()->id;
    $category_id = auth()->user()->category_id;
    $subscriber = Subscriber::where('user_id', $userId)->first();

    // Get all UserAccess records for the current user
    $userAccesses = UserAccess::where('user_id', $userId)
        ->where('status', 'approved')
        ->get();

    $investorIds = $userAccesses->pluck('investor_id')->toArray();

    $investors_data_usersubscribefor = Investor::query()
        ->whereIn('id', $investorIds)
        ->with('investmentDetails')
        ->get();

    // Filter investors
    $filteredInvestors = $investors_data_usersubscribefor->filter(function ($investor) use ($request) {
        $match = true;

        // 🔹 Filter by sector
        $sectors = $request->input('sector', []);
        if (!empty($sectors) && !empty($investor->sector_preferred)) {
            $match = $match && collect($sectors)->contains(fn($sector) =>
                str_contains($investor->sector_preferred, $sector)
            );
        }

        // 🔹 Filter by location
        $locations = $request->input('location', []);
        if (!empty($locations) && !empty($investor->address)) {
            $match = $match && collect($locations)->contains(fn($loc) =>
                str_contains($investor->address, $loc)
            );
        }

        // 🔹 Investment details
        $investmentDetails = $investor->investmentDetails;
        if ($investmentDetails) {

            // Investment size
            $investmentSizes = $request->input('investment_size', []);
            if (!empty($investmentSizes)) {
                $dbSize = $this->parseInvestmentSizeToNumber($investmentDetails->investment_size ?? '');
                $matchesArray = collect($investmentSizes)->contains(function ($range) use ($dbSize) {
                    if ($range === '<1000000') return $dbSize < 1000000;
                    if ($range === '1000000-5000000') return $dbSize >= 1000000 && $dbSize <= 5000000;
                    if ($range === '5000000-10000000') return $dbSize > 5000000 && $dbSize <= 10000000;
                    if ($range === '>10000000') return $dbSize > 10000000;
                    return false;
                });
                $match = $match && $matchesArray;
            }

            // Investment tenure
            $investmentTenures = $request->input('investment_tenure', []);
            if (!empty($investmentTenures)) {
                $normalizedTenure = $this->normalizeTenure($investmentDetails->investment_tenure);
                $match = $match && collect($investmentTenures)->contains(
                    fn($selectedTenure) => $this->isOverlappingTenure2($selectedTenure, $normalizedTenure)
                );
            }

            // Investor type
            $investorTypes = $request->input('investor_type', []);
            if (!empty($investorTypes) && !empty($investmentDetails->investor_type)) {
                $match = $match && collect($investorTypes)->contains(fn($type) =>
                    str_contains($investmentDetails->investor_type, $type)
                );
            }
        }

        return $match;
    });

    // Convert collection back to array for sorting
    $filteredInvestors = $filteredInvestors->values();

    // 🔹 Apply sorting
    $sort = $request->input('sort', null);
    if ($sort === 'Investor Name (Ascending)') {
        $filteredInvestors = $filteredInvestors->sortBy('investor_name')->values();
    } elseif ($sort === 'Investor Name (Descending)') {
        $filteredInvestors = $filteredInvestors->sortByDesc('investor_name')->values();
    } elseif ($sort === 'Investment Size (Low to High)') {
        $filteredInvestors = $filteredInvestors->sortBy(
            fn($inv) => $this->parseInvestmentSizeToNumber(optional($inv->investmentDetails)->investment_size ?? 0)
        )->values();
    } elseif ($sort === 'Investment Size (High to Low)') {
        $filteredInvestors = $filteredInvestors->sortByDesc(
            fn($inv) => $this->parseInvestmentSizeToNumber(optional($inv->investmentDetails)->investment_size ?? 0)
        )->values();
    }

    return view('partials.investor_list', [
        'investors'  => $filteredInvestors,
        'subscriber' => $subscriber
    ]);
}

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


function isOverlappingTenure2($selected, $normalized) {
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


 public function selectCategoryView(Request $request)
 {
    $category_id = auth()->user()->category_id;
    if($category_id == 1){
        return view('areaofintrest.properties');    
    }elseif($category_id == 2){
        return view('areaofintrest.companies');
    }elseif($category_id == 3){
        return view('areaofintrest.properties');
    }else{
        return view('areaofintrest.properties');
    }

    
    return view('areaofintrest.properties');
 }
 
 
public function sectorintresteddata2(Request $request)
{
    //print to debug data received
     Log::info('Request Data: ', $request->all());  
    $sectors           = (array) $request->input('sector');
    $locations         = (array) $request->input('location');
    $investment_size   = $request->input('investment_size');
    $investment_tenure = $request->input('investment_tenure');
    $investor_type     = $request->input('investor_type');

    $userId = auth()->id();

    // Latest subscription
    $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)
        ->latest()
        ->first();

    $data_no = $subscriptionRequest ? $subscriptionRequest->no_of_data : 0;

    // Investors matching ANY filter
    $investorsmatch = Investor::where(function ($query) use ($sectors, $locations, $investment_size, $investment_tenure, $investor_type) {

        // 🔹 Sectors filter
        if (!empty($sectors)) {
            $query->orWhere(function ($q) use ($sectors) {
                foreach ($sectors as $sector) {
                    $normalizedSector = strtolower(str_replace(['-', '&'], [' ', ' '], trim($sector)));
                    $q->orWhereRaw("
                        REPLACE(REPLACE(LOWER(sectors_preferred), '-', ' '), '&', ' ')
                        LIKE ?
                    ", ["%$normalizedSector%"]);
                }
            });
        }

        // 🔹 Locations filter
        if (!empty($locations)) {
            $query->orWhere(function ($q) use ($locations) {
                foreach ($locations as $location) {
                    $normalizedLocation = strtolower(preg_replace('/[^a-z0-9\s]/i', ' ', $location));
                    $normalizedLocation = preg_replace('/\s+/', ' ', $normalizedLocation);

                    $q->orWhereRaw("
                        REPLACE(REPLACE(REPLACE(REPLACE(LOWER(address), ',', ' '), '-', ' '), '&', ' '), ';', ' ')
                        LIKE ?
                    ", ["%$normalizedLocation%"]);
                }
            });
        }

       // 🔹 Investment size
    if (!empty($investment_size)) {
        $sizes = (array) $investment_size; // force array
        $query->orWhereHas('investmentDetails', function ($q) use ($sizes) {
            foreach ($sizes as $size) {
                $q->orWhere('investment_size', 'like', "%{$size}%");
            }
        });
    }

    // 🔹 Investment tenure
    if (!empty($investment_tenure)) {
        $tenures = (array) $investment_tenure;
        $query->orWhereHas('investmentDetails', function ($q) use ($tenures) {
            foreach ($tenures as $tenure) {
                $q->orWhere('investment_tenure', 'like', "%{$tenure}%");
            }
        });
    }

    // 🔹 Investor type
    if (!empty($investor_type)) {
        $types = (array) $investor_type;
        $query->orWhereHas('investmentDetails', function ($q) use ($types) {
            foreach ($types as $type) {
                $q->orWhere('investor_type', 'like', "%{$type}%");
            }
        });
    }

    })
    ->take($data_no) // Limit by subscription
    ->get();

    // How many more needed
    $required_Data = max(0, $data_no - $investorsmatch->count());

    // Store access
    foreach ($investorsmatch as $investor) {
        UserAccess::firstOrCreate([
            'user_id'     => $userId,
            'investor_id' => $investor->id,
        ], [
            'company_id' => $investor->company_id,
            'status' => 'pending',
            'granted_by_user_id' => null,
            'start_date' => now(),
            'end_date'   => now()->addDays(360),
        ]);
    }

    // Fill with randoms if needed
    if ($required_Data > 0) {
        $extraInvestors = Investor::whereNotIn('id', $investorsmatch->pluck('id'))
            ->whereNotIn('id', UserAccess::where('user_id', $userId)->pluck('investor_id'))
            ->inRandomOrder()
            ->take($required_Data)
            ->get();

        foreach ($extraInvestors as $investor) {
            UserAccess::firstOrCreate([
                'user_id'     => $userId,
                'investor_id' => $investor->id,
            ], [
                'company_id' => $investor->company_id,
                'status' => 'pending',
                'granted_by_user_id' => null,
                'start_date' => now(),
                'end_date'   => now()->addDays(360),
            ]);
        }
    }

    return redirect()->route('home')->with('success', 'Your subscription will be activated soon.');
}


public function sectorintresteddata(Request $request)
{
    Log::info('SectorInterested Session Data:', session()->all());
    log::info('sectorintresteddata called');
    $userId      = auth()->id();
    $investorIds = session('investor_ids', []);
    $userAccess  = session('userAccess', []);
    $subscriber  = session('subscriber');

       // Subscription — how many new investors to assign
    $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)->latest()->first();
    $data_no = max(0, (int) ($subscriptionRequest->no_of_data ?? 0));

    if ($data_no === 0) {
        return redirect()->route('home')
            ->with('info', 'No new data requested.');
    }

    // Investors user already filtered in index()
    $filteredInvestors = Investor::with('investmentDetails')
        ->whereIn('id', $investorIds)
        ->get();

    // All investors for random backfill
    $allInvestors = Investor::with('investmentDetails')->get();

    // Remove already assigned investors
    // $assignedSet = collect($userAccess)->flip();
    $assignedSet = collect($userAccess)
    ->filter(fn($v) => is_numeric($v))   // keep only numbers
    ->map(fn($v) => (int)$v)             // convert to integer
    ->unique()                           // remove duplicates
    ->flip();

    $filteredInvestors = $filteredInvestors->reject(fn($inv) => $assignedSet->has($inv->id));
    $allInvestors = $allInvestors->reject(fn($inv) => $assignedSet->has($inv->id));

    // STEP 1: Take from filtered first
    $selected = $filteredInvestors->take($data_no);

    $remaining = $data_no - $selected->count();

    // STEP 2: Random backfill (no duplicates)
    if ($remaining > 0) {
        $randomFill = $allInvestors
            ->whereNotIn('id', $selected->pluck('id'))
            ->shuffle()
            ->take($remaining);

        $selected = $selected->merge($randomFill);
    }

    // Save into UserAccess
    foreach ($selected as $inv) {
        UserAccess::create([
            'user_id'     => $userId,
            'investor_id' => $inv->id,
            'subscription_request_id' => $subscriptionRequest->id,
        ]);
    }
     // clear session data
     session()->forget(['investor_ids', 'user_access', 'subscriber']);


    return redirect()->route('home')->with('success', 'Investors assigned successfully!');
}

public function sectorInterestedDatacompany(Request $request)
{
    Log::info('SectorInterested Session Data:', session()->all());
    log::info('sectorInterestedDatacompany called');
    $userId = auth()->id();

    // Company IDs filtered in search()
    $companyIds = session('investee_ids', []);   // same as investor code but for companies

    // User's approved access list for companies
    $userAccess = session('user_access_investee_id', []); 

    // Subscriber details
    $subscriber = session('subscriber_investee');

       // Fetch latest subscription request
    $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)
        ->latest()
        ->first();

    $data_no = max(0, (int) ($subscriptionRequest->no_of_data ?? 0));

    if ($data_no === 0) {
        return redirect()->route('home')
            ->with('info', 'No new data requested.');
    }

    // STEP 1: Get filtered companies from search()
    $filteredCompanies = Company::with([
        'user', 'concernedPerson', 'founders', 
        'fundRequirements', 'previousRounds',
        'otherLinks', 'attachments', 'referralSource'
    ])
    ->whereIn('id', $companyIds)
    ->get();

    // STEP 2: Get all companies for random backfill
    $allCompanies = Company::with([
        'user', 'concernedPerson', 'founders', 
        'fundRequirements', 'previousRounds',
        'otherLinks', 'attachments', 'referralSource'
    ])->get();

    // Clean userAccess (only company_id)
    $assignedSet = collect($userAccess)
        ->filter(fn($v) => is_numeric($v))
        ->map(fn($v) => (int)$v)
        ->unique()
        ->flip();

    // Remove already assigned companies
    $filteredCompanies = $filteredCompanies->reject(fn($c) => $assignedSet->has($c->id));
    $allCompanies = $allCompanies->reject(fn($c) => $assignedSet->has($c->id));

    // STEP 3: Take from filtered companies first
    $selected = $filteredCompanies->take($data_no);

    $remaining = $data_no - $selected->count();

    // STEP 4: Fill remaining with RANDOM companies
    if ($remaining > 0) {
        $randomFill = $allCompanies
            ->whereNotIn('id', $selected->pluck('id'))
            ->shuffle()
            ->take($remaining);

        $selected = $selected->merge($randomFill);
    }

    // STEP 5: Save to user_accesses table (company_id field)
    foreach ($selected as $company) {
        UserAccess::create([
            'user_id'     => $userId,
            'company_id'  => $company->id,
            // 'status'      => 'approved',
            'subscription_request_id' => $subscriptionRequest->id,
            'start_date'  => now(),
            'end_date'    => now()->addDays(30),
        ]);
    }
     session()->forget(['investee_ids', 'user_access_investee_id', 'subscriber_investee']);


    return redirect()->route('home')
        ->with('success', 'Companies assigned successfully!');
}

public function sectorInterestedDataCombine(Request $request)
{
    Log::info('SectorInterested Session Data:', session()->all());
    log::info('sectorInterestedDataCombine called');    
    $userId = auth()->id();

    // -----------------------------
    // 1️⃣ DETECT WHICH TYPE WE ARE PROCESSING
    // -----------------------------
    $investorIds = session('investor_ids', []);
    $companyIds  = session('investee_ids', []);

    log::info('Investor IDs------------1:', $investorIds);
    log::info('Company IDs-------------2:', $companyIds);
    //check which value is available

    $savestype;
    if(empty($investorIds)){
        $savestype = 'company'; 
    }
    else{
        $savestype = 'investor';
    }
    $isInvestorMode = count($investorIds) > 0;
    $isCompanyMode  = count($companyIds) > 0;

    if (!$isInvestorMode && !$isCompanyMode) {
        return redirect()->route('home')
            ->with('info', 'No filtered data found.');
    }

    // -----------------------------
    // 2️⃣ SUBSCRIPTION LIMIT
    // -----------------------------
    $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)
        ->latest()
        ->first();

    $data_no = max(0, (int) ($subscriptionRequest->no_of_data ?? 0));

    if ($data_no === 0) {
        return redirect()->route('home')
            ->with('info', 'No new data requested.');
    }

    // -----------------------------
    // 3️⃣ ACCESS LIST BASED ON MODE
    // -----------------------------
    $userAccess = $isInvestorMode 
        ? session('userAccess', []) 
        : session('user_access_investee_id', []);

    $assignedSet = collect($userAccess)
        ->filter(fn($v) => is_numeric($v))
        ->map(fn($v) => (int)$v)
        ->unique()
        ->flip();

    // -----------------------------
    // 4️⃣ FETCH DATA BASED ON TYPE
    // -----------------------------
    if ($isInvestorMode) {

        // FILTERED INVESTORS
        $filtered = Investor::with('investmentDetails')
            ->whereIn('id', $investorIds)
            ->get();

        // ALL INVESTORS FOR RANDOM BACKFILL
        $all = Investor::with('investmentDetails')->get();

    } else {

        // FILTERED COMPANIES
        $filtered = Company::with([
            'user', 'concernedPerson', 'founders',
            'fundRequirements', 'previousRounds',
            'otherLinks', 'attachments', 'referralSource'
        ])
        ->whereIn('id', $companyIds)
        ->get();

        // ALL COMPANIES FOR RANDOM BACKFILL
        $all = Company::with([
            'user', 'concernedPerson', 'founders',
            'fundRequirements', 'previousRounds',
            'otherLinks', 'attachments', 'referralSource'
        ])->get();
    }

    // -----------------------------
    // 5️⃣ REMOVE ALREADY ASSIGNED ITEMS
    // -----------------------------
    $filtered = $filtered->reject(fn($item) => $assignedSet->has($item->id));
    $all = $all->reject(fn($item) => $assignedSet->has($item->id));

    // -----------------------------
    // 6️⃣ SELECT FROM FILTERED FIRST
    // -----------------------------
    $selected = $filtered->take($data_no);

    $remaining = $data_no - $selected->count();

    // -----------------------------
    // 7️⃣ RANDOM FILL IF REQUIRED
    // -----------------------------
    if ($remaining > 0) {
        $randomFill = $all
            ->whereNotIn('id', $selected->pluck('id'))
            ->shuffle()
            ->take($remaining);

        $selected = $selected->merge($randomFill);
    }

    // -----------------------------
    // 8️⃣ SAVE TO user_accesses
    // -----------------------------
    foreach ($selected as $item) {

        UserAccess::create([
            'user_id'     => $userId,
            // 'investor_id' => $isInvestorMode ? $item->id : null,
            // 'company_id'  => $isCompanyMode  ? $item->id : null,
            'investor_id' => $savestype == 'investor' ? $item->id : null,   
            'company_id'  => $savestype == 'company'  ? $item->id : null,
            // 'status'      => 'approved',
            'subscription_request_id' => $subscriptionRequest->id,
            'start_date'  => now(),
            'end_date'    => now()->addDays(60),
        ]);
    }

    session()->forget([
        'investor_ids', 
        'investee_ids', 
        'userAccess', 
        'user_access_investee_id', 
        'subscriber', 
        'subscriber_investee'
    ]);
    // -----------------------------
    // 9️⃣ REDIRECT WITH SUCCESS
    // -----------------------------
    return redirect()->route('home')
        ->with('success', $isInvestorMode 
            ? 'Investors assigned successfully!'
            : 'Companies assigned successfully!'
        );
}



// ✅ Normalize tenure string to months with detailed logs
private function parseTenureToMonths(string $tenure): ?int
{
    \Log::info("🔍 Raw tenure value from DB: {$tenure}");

    $tenure = strtolower(trim($tenure));

    if ($tenure === '' || str_contains($tenure, 'not')) {
        \Log::info("❌ Skipping tenure: Not specified or empty.");
        return null;
    }

    $years = 0; $months = 0;

    // Match years: "2y", "2 years", "2 y"
    if (preg_match('/(\d+)\s*(y|year|years)/', $tenure, $matches)) {
        $years = (int)$matches[1];
        \Log::info("✅ Years extracted: {$years}");
    }

    // Match months: "7m", "7 months", "7 m"
    if (preg_match('/(\d+)\s*(m|month|months)/', $tenure, $matches)) {
        $months = (int)$matches[1];
        \Log::info("✅ Months extracted: {$months}");
    }

    $totalMonths = $years * 12 + $months;
    \Log::info("📌 Final tenure in months: {$totalMonths}");

    return $totalMonths;
}

// ✅ Match selected tenure range with clear logs
private function matchesTenureRange(string $selected, ?int $months): bool
{
    if ($months === null) {
        \Log::info("⚠️ No tenure months available, skipping range: {$selected}");
        return false;
    }

    $match = false;
    switch ($selected) {
        case '0-1 years':
            $match = $months >= 0 && $months <= 12; break;
        case '1-3 years':
            $match = $months > 12 && $months <= 36; break;
        case '3-5 years':
            $match = $months > 36 && $months <= 60; break;
        case 'More than 5 years':
            $match = $months > 60; break;
    }

    \Log::info("🔎 Tenure check for '{$selected}' => Months: {$months} => Match: " . ($match ? 'YES' : 'NO'));

    return $match;
}



public function companycustomiseddata(Request $request)
{
    
    Log::info("ppppppppppppppppppppppppppppppppppppppppppppddddddddddddddddddddddddddddddddddddFunction companycustomiseddata called-------------------------------------------------");
    Log::info('CompanyCustomised Request:', $request->all());

    // Get filters from request
    $locations          = (array) $request->input('locations', []);
    $incorporated_years = (array) $request->input('incorporated_in', []);
    $usageoffunds       = (array) $request->input('fund_usage', []);
    Log::info("Incorporated Years: " . json_encode($incorporated_years));
    Log::info("Usage of Funds: " . json_encode($usageoffunds));
    Log::info("Locations: " . json_encode($locations));
    $user_id = auth()->id();
    $subscriptionRequest = SubscriptionRequest::where('user_id', $user_id)->latest()->first();
    $data_no = max(0, (int)($subscriptionRequest->no_of_data ?? 0));

    Log::info("Data No from Subscription: " . $data_no);
    if ($data_no === 0) {
        return redirect()->route('home')->with('info', 'No new data requested in this subscription.');
    }   
    Log::info("Data No requested: " . $data_no);
    // Helper: normalize keywords
    $toKeywords = function (array $values): array {
        $stopwords = ['and', 'or', 'the', 'of', 'in', 'on', 'for', 'to', 'a', 'an'];
        $all = [];
        foreach ($values as $v) {
            $v = strtolower($v);
            $v = preg_replace('/[^a-z0-9 ]+/i', ' ', $v);
            $parts = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($v))));
            foreach ($parts as $p) {
                if (strlen($p) >= 2 && !in_array($p, $stopwords)) $all[] = $p;
            }
        }
        return array_values(array_unique($all));
    };

    Log::info("Locations: " . json_encode($locations));
    $locationKeywords = $toKeywords($locations);
    $usageKeywords    = $toKeywords($usageoffunds);

    Log::info('Normalized Filters', [
        'locations'          => $locationKeywords,
        'incorporated_years' => $incorporated_years,
        'usageoffunds'       => $usageKeywords,
        'data_no'            => $data_no,
    ]);
    Log::info("Location Keywords: " . json_encode($locationKeywords));
    // Already assigned companies
    $alreadyAssignedIds = UserAccess::where('user_id', $user_id)->pluck('company_id')->toArray();

    // Get all companies
    $companies = Company::with('fundRequirements')->get();
    Log::info("Total companies in DB: " . $companies->count());
  

    $filteredCompanies = $companies->filter(function ($comp) use ($locationKeywords, $incorporated_years, $usageKeywords) {
    $match = false;
    $matchReasons = [];

    // Location match
    if (!empty($locationKeywords)) {
        $addr = strtolower($comp->address ?? '');
        foreach ($locationKeywords as $word) {
            if (str_contains($addr, $word)) {
                $match = true;
                $matchReasons[] = "Location match: '{$word}' found in '{$addr}'";
                break;
            }
        }
    }

    // Incorporated year match
    if (!$match && !empty($incorporated_years)) {
        foreach ($incorporated_years as $yearRange) {
            if ($this->matchesIncorporationRange($yearRange, $comp->incorporated_in ?? null)) {
                $match = true;
                $matchReasons[] = "Incorporated year match: '{$comp->incorporated_in}' matched with '{$yearRange}'";
                break;
            }
        }
    }

    // Usage of funds match
    if (!$match && !empty($usageKeywords) && $comp->fundRequirements->isNotEmpty()) {
        foreach ($comp->fundRequirements as $req) {
            $dbUsage = strtolower($req->usage ?? '');
            foreach ($usageKeywords as $usage) {
                if (str_contains($dbUsage, $usage)) {
                    $match = true;
                    $matchReasons[] = "Usage of fund match: '{$usage}' found in '{$dbUsage}'";
                    break 2; // exit both loops
                }
            }
        }
    }

    if ($match) {
        \Log::info("Company ID {$comp->id} matched because: ", $matchReasons);
    } else {
        \Log::info("Company ID {$comp->id} did not match any filter.");
    }

    return $match;
    });

    Log::info("Filtered companies count after applying filters: " . $filteredCompanies->count());
    // Exclude already assigned companies
    $filteredCompanies = $filteredCompanies->whereNotIn('id', $alreadyAssignedIds);
    $allAvailablePool  = $companies->whereNotIn('id', $alreadyAssignedIds);

    Log::info('Pool sizes after excluding already assigned', [
        'filtered_available' => $filteredCompanies->count(),
        'all_available'      => $allAvailablePool->count(),
        'requested_new'      => $data_no,
    ]);

    // Pick up to data_no from filtered pool
    $finalCompanies = $filteredCompanies->take($data_no);

    // Backfill randomly if not enough filtered
    if ($finalCompanies->count() < $data_no) {
        $remaining = $data_no - $finalCompanies->count();
        $extras = $allAvailablePool
            ->whereNotIn('id', $finalCompanies->pluck('id')->all())
            ->shuffle() // randomize
            ->take($remaining);

        $finalCompanies = $finalCompanies->merge($extras);
    }

    // Ensure we never exceed data_no
    if ($finalCompanies->count() > $data_no) {
        $finalCompanies = $finalCompanies->take($data_no);
    }

    // Determine subscription_request_id safely
    $subscriptionRequestId = $subscriptionRequest instanceof \App\Models\SubscriptionRequest
        ? $subscriptionRequest->id
        : null;

    // Assign companies to user
    foreach ($finalCompanies as $comp) {
        UserAccess::updateOrCreate(
            ['user_id' => $user_id, 'company_id' => $comp->id],
            [
                'status'                 => 'pending',
                'start_date'             => now(),
                'end_date'               => now()->addDays(360),
                'subscription_request_id'=> $subscriptionRequestId
            ]
        );
    }
    Log::info("Final Companies Assigned to User ID {$user_id}: " . $finalCompanies->pluck('id')->implode(', '));
    $inserted = $finalCompanies->count();
    // $msg = $inserted < $data_no
    //     ? "{$inserted} companies (not enough unique records available to reach {$data_no})."
    //     : "{$inserted} companies are requested.";
    $msg = $inserted < $data_no 
    ? "Your request has been sent. {$inserted} companies added (not enough unique records available to reach {$data_no})." 
    : "Your request has been sent. {$inserted} companies are requested.";


    Log::info('Final Companies Selected', [
        'count' => $inserted,
        'ids'   => $finalCompanies->pluck('id')->all(),
    ]);

    return redirect()->route('home')->with('success', $msg);
}

private function matchesIncorporationRange($compYear, $yearValue)
{
    // If user didn't provide a year, don't filter (always true)
    if (empty($yearValue)) {
        return true;
    }

    // If it's a single year (e.g. 2023, 2022 etc.)
    if (is_numeric($yearValue) && strlen($yearValue) === 4) {
        return (int)$compYear === (int)$yearValue;
    }

    return false; // If it's something invalid
}



}