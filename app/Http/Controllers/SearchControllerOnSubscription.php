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


// public function sectorintresteddata(Request $request)
// {
//     Log::info('SectorInterested Request:', $request->all());

//     $sectors            = (array) $request->input('sector', []);
//     $locations          = (array) $request->input('location', []);
//     $investment_sizes   = (array) $request->input('investment_size', []);
//     $investment_tenures = (array) $request->input('investment_tenure', []);
//     $investor_types     = (array) $request->input('investor_type', []);

//     $userId = auth()->id();
//     $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)->latest()->first();
//     $data_no = $subscriptionRequest ? $subscriptionRequest->data_no : 0;

//     // 🔹 Helper: Normalize keywords
//     $toKeywords = function (array $values): array {
//         $stopwords = ['and', 'or', 'the', 'of', 'in', 'on', 'for', 'to', 'a', 'an'];
//         $all = [];
//         foreach ($values as $v) {
//             $v = strtolower($v);
//             $v = preg_replace('/[^a-z0-9 ]+/i', ' ', $v);
//             $parts = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($v))));
//             foreach ($parts as $p) {
//                 if (strlen($p) >= 2 && !in_array($p, $stopwords)) {
//                     $all[] = $p;
//                 }
//             }
//         }
//         return array_values(array_unique($all));
//     };

//     $sectorKeywords   = $toKeywords($sectors);
//     $locationKeywords = $toKeywords($locations);

//     Log::info("Normalized Filters", [
//         'sectorKeywords'     => $sectorKeywords,
//         'locationKeywords'   => $locationKeywords,
//         'investment_sizes'   => $investment_sizes,
//         'investment_tenures' => $investment_tenures,
//         'investor_types'     => $investor_types,
//     ]);

//     // 🔹 Fetch all investors with details
//     $investors = Investor::with('investmentDetails')->get();

//     // 🔹 Apply OR logic across all filters
//     $filteredInvestors = $investors->filter(function ($inv) use (
//         $sectorKeywords, $locationKeywords, $investment_sizes, $investment_tenures, $investor_types
//     ) {
//         $details = $inv->investmentDetails;
//         $match = false;

//         // Sector match
//         if (!empty($sectorKeywords)) {
//             $normalized = strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $inv->sectors_preferred ?? ''));
//             $dbTokens = array_filter(explode(' ', preg_replace('/\s+/', ' ', $normalized)));
//             $matches = array_intersect($sectorKeywords, $dbTokens);
//             if (!empty($matches)) $match = true;
//         }

//         // Location match
//         if (!$match && !empty($locationKeywords)) {
//             $addr = strtolower($inv->address ?? '');
//             foreach ($locationKeywords as $word) {
//                 if (str_contains($addr, $word)) {
//                     $match = true; break;
//                 }
//             }
//         }

//         // Investment Size match
//         if (!$match && !empty($investment_sizes) && $details) {
//             $dbSize = $this->parseInvestmentSizeToNumber($details->investment_size ?? '');
//             foreach ($investment_sizes as $range) {
//                 if ($range === '<1000000' && $dbSize < 1000000) { $match = true; break; }
//                 if ($range === '1000000-5000000' && $dbSize >= 1000000 && $dbSize <= 5000000) { $match = true; break; }
//                 if ($range === '5000000-10000000' && $dbSize > 5000000 && $dbSize <= 10000000) { $match = true; break; }
//                 if ($range === '>10000000' && $dbSize > 10000000) { $match = true; break; }
//             }
//         }

//         // Tenure match
//         if (!$match && !empty($investment_tenures) && $details) {
//             $tenureMonths = $this->parseTenureToMonths($details->investment_tenure ?? '');
//             foreach ($investment_tenures as $selectedTenure) {
//                 if ($this->matchesTenureRange($selectedTenure, $tenureMonths)) {
//                     $match = true; break;
//                 }
//             }
//         }

//         // Investor Type match
//         if (!$match && !empty($investor_types) && $details) {
//             $dbType = strtolower($details->investor_type ?? '');
//             foreach ($investor_types as $type) {
//                 if (str_contains($dbType, strtolower($type))) {
//                     $match = true; break;
//                 }
//             }
//         }

//         return $match;
//     });

//     // 🔹 Now handle data count scenarios
//     $matchedCount = $filteredInvestors->count();
//     Log::info("Filtered Investors Count", ['matched' => $matchedCount, 'required' => $data_no]);

//     if ($matchedCount >= $data_no) {
//         // ✅ Have enough data, just take $data_no
//         $finalInvestors = $filteredInvestors->take($data_no);
//     } else {
//         // ❌ Not enough data, fill from all investors (excluding already chosen)
//         $remaining = $data_no - $matchedCount;
//         $extraInvestors = $investors->whereNotIn('id', $filteredInvestors->pluck('id'))
//                                    ->take($remaining);
//         $finalInvestors = $filteredInvestors->merge($extraInvestors);
//     }

//     Log::info("Final Investors", [
//         'count' => $finalInvestors->count(),
//         'ids' => $finalInvestors->pluck('id')
//     ]);

//     // 🔹 Save User Access
//     foreach ($finalInvestors as $inv) {
//         UserAccess::firstOrCreate(
//             ['user_id' => $userId, 'investor_id' => $inv->id],
//             [
//                 'company_id' => $inv->company_id,
//                 'status'     => 'pending',
//                 'start_date' => now(),
//                 'end_date'   => now()->addDays(360),
//             ]
//         );
//     }

//     return redirect()->route('home')->with('success', 'Your subscription will be activated soon.');
// }

// public function sectorintresteddata(Request $request)
// {
//     Log::info('SectorInterested Request:', $request->all());

//     $sectors            = (array) $request->input('sector', []);
//     $locations          = (array) $request->input('location', []);
//     $investment_sizes   = (array) $request->input('investment_size', []);
//     $investment_tenures = (array) $request->input('investment_tenure', []);
//     $investor_types     = (array) $request->input('investor_type', []);

//     $userId = auth()->id();
//     $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)->latest()->first();
//     $data_no = $subscriptionRequest ? $subscriptionRequest->data_no : 0;

//     // 🔹 Helper: Normalize keywords
//     $toKeywords = function (array $values): array {
//         $stopwords = ['and', 'or', 'the', 'of', 'in', 'on', 'for', 'to', 'a', 'an'];
//         $all = [];
//         foreach ($values as $v) {
//             $v = strtolower($v);
//             $v = preg_replace('/[^a-z0-9 ]+/i', ' ', $v);
//             $parts = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($v))));
//             foreach ($parts as $p) {
//                 if (strlen($p) >= 2 && !in_array($p, $stopwords)) {
//                     $all[] = $p;
//                 }
//             }
//         }
//         return array_values(array_unique($all));
//     };

//     $sectorKeywords   = $toKeywords($sectors);
//     $locationKeywords = $toKeywords($locations);

//     Log::info("Normalized Filters", [
//         'sectorKeywords'     => $sectorKeywords,
//         'locationKeywords'   => $locationKeywords,
//         'investment_sizes'   => $investment_sizes,
//         'investment_tenures' => $investment_tenures,
//         'investor_types'     => $investor_types,
//     ]);

//     // 🔹 STEP 1: Get all investors with details
//     $investors = Investor::with('investmentDetails')->get();

//     // 🔹 STEP 2: Apply your OR logic filters
//     $filteredInvestors = $investors->filter(function ($inv) use (
//         $sectorKeywords, $locationKeywords, $investment_sizes, $investment_tenures, $investor_types
//     ) {
//         $details = $inv->investmentDetails;
//         $match = false;

//         // Sector match
//         if (!empty($sectorKeywords)) {
//             $normalized = strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $inv->sectors_preferred ?? ''));
//             $dbTokens = array_filter(explode(' ', preg_replace('/\s+/', ' ', $normalized)));
//             if (!empty(array_intersect($sectorKeywords, $dbTokens))) {
//                 $match = true;
//             }
//         }

//         // Location match
//         if (!$match && !empty($locationKeywords)) {
//             $addr = strtolower($inv->address ?? '');
//             foreach ($locationKeywords as $word) {
//                 if (str_contains($addr, $word)) {
//                     $match = true;
//                     break;
//                 }
//             }
//         }

//         // Investment Size match
//         if (!$match && !empty($investment_sizes) && $details) {
//             $dbSize = $this->parseInvestmentSizeToNumber($details->investment_size ?? '');
//             foreach ($investment_sizes as $range) {
//                 if (
//                     ($range === '<1000000' && $dbSize < 1000000) ||
//                     ($range === '1000000-5000000' && $dbSize >= 1000000 && $dbSize <= 5000000) ||
//                     ($range === '5000000-10000000' && $dbSize > 5000000 && $dbSize <= 10000000) ||
//                     ($range === '>10000000' && $dbSize > 10000000)
//                 ) {
//                     $match = true;
//                     break;
//                 }
//             }
//         }

//         // Tenure match
//         if (!$match && !empty($investment_tenures) && $details) {
//             $tenureMonths = $this->parseTenureToMonths($details->investment_tenure ?? '');
//             foreach ($investment_tenures as $selectedTenure) {
//                 if ($this->matchesTenureRange($selectedTenure, $tenureMonths)) {
//                     $match = true;
//                     break;
//                 }
//             }
//         }

//         // Investor Type match
//         if (!$match && !empty($investor_types) && $details) {
//             $dbType = strtolower($details->investor_type ?? '');
//             foreach ($investor_types as $type) {
//                 if (str_contains($dbType, strtolower($type))) {
//                     $match = true;
//                     break;
//                 }
//             }
//         }

//         return $match;
//     });

//     // 🔹 STEP 3: Get already assigned investors for this user
//     $alreadyAssigned = UserAccess::where('user_id', $userId)->pluck('investor_id')->toArray();

//     // 🔹 STEP 4: Remove already assigned investors
//     $filteredInvestors = $filteredInvestors->whereNotIn('id', $alreadyAssigned);

//     // 🔹 STEP 5: Select final investors
//     $needed = $data_no;
//     $finalInvestors = $filteredInvestors->take($needed);

//     if ($finalInvestors->count() < $needed) {
//         $remaining = $needed - $finalInvestors->count();
//         $extraInvestors = $investors->whereNotIn('id', array_merge(
//             $alreadyAssigned,
//             $finalInvestors->pluck('id')->toArray()
//         ))->take($remaining);

//         $finalInvestors = $finalInvestors->merge($extraInvestors);
//     }

//     Log::info("Final Investors Selected", [
//         'count' => $finalInvestors->count(),
//         'ids' => $finalInvestors->pluck('id')->toArray()
//     ]);

//     // 🔹 STEP 6: Save unique UserAccess entries
//     foreach ($finalInvestors as $inv) {
//         UserAccess::firstOrCreate(
//             ['user_id' => $userId, 'investor_id' => $inv->id],
//             [
//                 'company_id' => $inv->company_id,
//                 'status'     => 'pending',
//                 'start_date' => now(),
//                 'end_date'   => now()->addDays(360),
//             ]
//         );
//     }

//     return redirect()->route('home')->with('success', 'Your subscription will be activated soon.');
// }




// public function sectorintresteddata(Request $request)
// {
//     Log::info('SectorInterested Request:', $request->all());

//     $sectors            = (array) $request->input('sector', []);
//     $locations          = (array) $request->input('location', []);
//     $investment_sizes   = (array) $request->input('investment_size', []);
//     $investment_tenures = (array) $request->input('investment_tenure', []);
//     $investor_types     = (array) $request->input('investor_type', []);

//     $userId = auth()->id();
//     $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)->latest()->first();
//     $data_no = $subscriptionRequest ? $subscriptionRequest->data_no : 0;

//     // 🔹 Helper: Normalize keywords
//     $toKeywords = function (array $values): array {
//         $stopwords = ['and', 'or', 'the', 'of', 'in', 'on', 'for', 'to', 'a', 'an'];
//         $all = [];
//         foreach ($values as $v) {
//             $v = strtolower($v);
//             $v = preg_replace('/[^a-z0-9 ]+/i', ' ', $v);
//             $parts = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($v))));
//             foreach ($parts as $p) {
//                 if (strlen($p) >= 2 && !in_array($p, $stopwords)) {
//                     $all[] = $p;
//                 }
//             }
//         }
//         return array_values(array_unique($all));
//     };

//     $sectorKeywords   = $toKeywords($sectors);
//     $locationKeywords = $toKeywords($locations);

//     Log::info("Normalized Filters", [
//         'sectorKeywords'     => $sectorKeywords,
//         'locationKeywords'   => $locationKeywords,
//         'investment_sizes'   => $investment_sizes,
//         'investment_tenures' => $investment_tenures,
//         'investor_types'     => $investor_types,
//     ]);

//     // 🔹 Fetch all investors with details
//     $investors = Investor::with('investmentDetails')->get();

//     // 🔹 Apply OR logic across all filters
//     $filteredInvestors = $investors->filter(function ($inv) use (
//         $sectorKeywords, $locationKeywords, $investment_sizes, $investment_tenures, $investor_types
//     ) {
//         $details = $inv->investmentDetails;
//         $match = false; // We want OR logic, so start with false

//         // 🔸 Sector match
//         if (!empty($sectorKeywords)) {
//             $normalized = strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $inv->sectors_preferred ?? ''));
//             $dbTokens = array_filter(explode(' ', preg_replace('/\s+/', ' ', $normalized)));
//             $matches = array_intersect($sectorKeywords, $dbTokens);
//             if (!empty($matches)) $match = true;

//             Log::info("Sector Match Debug", [
//                 'investor_id' => $inv->id,
//                 'searched' => $sectorKeywords,
//                 'db' => $inv->sectors_preferred,
//                 'matches' => $matches
//             ]);
//         }

//         // 🔸 Location match
//         if (!$match && !empty($locationKeywords)) {
//             $addr = strtolower($inv->address ?? '');
//             foreach ($locationKeywords as $word) {
//                 if (str_contains($addr, $word)) {
//                     $match = true; break;
//                 }
//             }
//         }

//         // 🔸 Investment Size match
//         if (!$match && !empty($investment_sizes) && $details) {
//             $dbSize = $this->parseInvestmentSizeToNumber($details->investment_size ?? '');
//             foreach ($investment_sizes as $range) {
//                 if ($range === '<1000000' && $dbSize < 1000000) { $match = true; break; }
//                 if ($range === '1000000-5000000' && $dbSize >= 1000000 && $dbSize <= 5000000) { $match = true; break; }
//                 if ($range === '5000000-10000000' && $dbSize > 5000000 && $dbSize <= 10000000) { $match = true; break; }
//                 if ($range === '>10000000' && $dbSize > 10000000) { $match = true; break; }
//             }
//         }

//         // 🔸 Tenure match
//         if (!$match && !empty($investment_tenures) && $details) {
//             $tenureMonths = $this->parseTenureToMonths($details->investment_tenure ?? '');
//             foreach ($investment_tenures as $selectedTenure) {
//                 if ($this->matchesTenureRange($selectedTenure, $tenureMonths)) {
//                     $match = true; break;
//                 }
//             }
//         }

//         // 🔸 Investor Type match
//         if (!$match && !empty($investor_types) && $details) {
//             $dbType = strtolower($details->investor_type ?? '');
//             foreach ($investor_types as $type) {
//                 if (str_contains($dbType, strtolower($type))) {
//                     $match = true; break;
//                 }
//             }
//         }

//         return $match;
//     });

//     Log::info("Final Matched Investors", [
//         'count' => $filteredInvestors->count(),
//         'ids'   => $filteredInvestors->pluck('id')
//     ]);

//     // 🔹 Apply data_no limit
//     $filteredInvestors = $filteredInvestors->take($data_no);

//     // 🔹 Save User Access
//     foreach ($filteredInvestors as $inv) {
//         UserAccess::firstOrCreate(
//             ['user_id' => $userId, 'investor_id' => $inv->id],
//             [
//                 'company_id' => $inv->company_id,
//                 'status'     => 'pending',
//                 'start_date' => now(),
//                 'end_date'   => now()->addDays(360),
//             ]
//         );
//     }

//     return redirect()->route('home')->with('success', 'Your subscription will be activated soon.');
// }

public function sectorintresteddata(Request $request)
{
    Log::info('SectorInterested Request:', $request->all());

    $sectors            = (array) $request->input('sector', []);
    $locations          = (array) $request->input('location', []);
    $investment_sizes   = (array) $request->input('investment_size', []);
    $investment_tenures = (array) $request->input('investment_tenure', []);
    $investor_types     = (array) $request->input('investor_type', []);

    $userId = auth()->id();
    $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)->latest()->first();
    $data_no = max(0, (int)($subscriptionRequest->no_of_data ?? 0)); // how many NEW records to add now

    // helper: normalize keywords
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

    $sectorKeywords   = $toKeywords($sectors);
    $locationKeywords = $toKeywords($locations);

    Log::info('Normalized Filters', [
        'sectorKeywords'     => $sectorKeywords,
        'locationKeywords'   => $locationKeywords,
        'investment_sizes'   => $investment_sizes,
        'investment_tenures' => $investment_tenures,
        'investor_types'     => $investor_types,
        'data_no'            => $data_no,
    ]);

    // nothing to add
    if ($data_no === 0) {
        return redirect()->route('home')->with('info', 'No new data requested in this subscription.');
    }

    // all investors + details
    $investors = Investor::with('investmentDetails')->get();

    // OR logic across all filters
    $filteredInvestors = $investors->filter(function ($inv) use (
        $sectorKeywords, $locationKeywords, $investment_sizes, $investment_tenures, $investor_types
    ) {
        $details = $inv->investmentDetails;
        $match = false;

        // sector
        if (!empty($sectorKeywords)) {
            $normalized = strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $inv->sectors_preferred ?? ''));
            $dbTokens = array_filter(explode(' ', preg_replace('/\s+/', ' ', $normalized)));
            if (!empty(array_intersect($sectorKeywords, $dbTokens))) $match = true;
        }

        // location
        if (!$match && !empty($locationKeywords)) {
            $addr = strtolower($inv->address ?? '');
            foreach ($locationKeywords as $word) {
                if (str_contains($addr, $word)) { $match = true; break; }
            }
        }

        // investment size
        if (!$match && !empty($investment_sizes) && $details) {
            $dbSize = $this->parseInvestmentSizeToNumber($details->investment_size ?? '');
            foreach ($investment_sizes as $range) {
                if (
                    ($range === '<1000000' && $dbSize < 1000000) ||
                    ($range === '1000000-5000000' && $dbSize >= 1000000 && $dbSize <= 5000000) ||
                    ($range === '5000000-10000000' && $dbSize > 5000000 && $dbSize <= 10000000) ||
                    ($range === '>10000000' && $dbSize > 10000000)
                ) { $match = true; break; }
            }
        }

        // tenure
        if (!$match && !empty($investment_tenures) && $details) {
            $tenureMonths = $this->parseTenureToMonths($details->investment_tenure ?? '');
            foreach ($investment_tenures as $selectedTenure) {
                if ($this->matchesTenureRange($selectedTenure, $tenureMonths)) { $match = true; break; }
            }
        }

        // investor type
        if (!$match && !empty($investor_types) && $details) {
            $dbType = strtolower($details->investor_type ?? '');
            foreach ($investor_types as $type) {
                if (str_contains($dbType, strtolower($type))) { $match = true; break; }
            }
        }

        return $match;
    });

    // do not assign duplicates from any past subscriptions
    $alreadyAssignedIds = UserAccess::where('user_id', $userId)->pluck('investor_id')->all();

    // remove already assigned from both pools
    $filteredInvestors = $filteredInvestors->whereNotIn('id', $alreadyAssignedIds);
    $allAvailablePool  = $investors->whereNotIn('id', $alreadyAssignedIds);

    Log::info('Pool sizes after excluding already assigned', [
        'filtered_available' => $filteredInvestors->count(),
        'all_available'      => $allAvailablePool->count(),
        'requested_new'      => $data_no,
    ]);

    // pick up to data_no from filtered pool
    $finalInvestors = $filteredInvestors->take($data_no);

    // if not enough filtered, backfill from the general pool (still excluding already picked)
    if ($finalInvestors->count() < $data_no) {
        $remaining = $data_no - $finalInvestors->count();
        $extras = $allAvailablePool
            ->whereNotIn('id', $finalInvestors->pluck('id')->all())
            ->take($remaining);

        $finalInvestors = $finalInvestors->merge($extras);
    }

    // absolute safety: ensure we never exceed data_no in this run
    if ($finalInvestors->count() > $data_no) {
        $finalInvestors = $finalInvestors->take($data_no);
    }

    Log::info('Final Investors Selected (new inserts only)', [
        'count' => $finalInvestors->count(),
        'ids'   => $finalInvestors->pluck('id')->all(),
    ]);

    
    // insert new user_accesses (firstOrCreate prevents duplicate rows)
    // foreach ($finalInvestors as $inv) {
    //     UserAccess::firstOrCreate(
    //         ['user_id' => $userId, 'investor_id' => $inv->id],
    //         [
    //             'company_id' => $inv->company_id,
    //             'status'     => 'pending',
    //             'start_date' => now(),
    //             'end_date'   => now()->addDays(360),
    //             'subscription_request_id' => $subscriptionRequest->id ?? null
    //         ]
    //     );
    // }
     // insert/update UserAccess with subscription_request_id
   $subscriptionRequestId = null;

// check if it's nested
if (is_array($subscriptionRequest) && isset($subscriptionRequest['App\\Models\\SubscriptionRequest'])) {
    $subscriptionRequestId = $subscriptionRequest['App\\Models\\SubscriptionRequest']->id;
} elseif ($subscriptionRequest instanceof \App\Models\SubscriptionRequest) {
    $subscriptionRequestId = $subscriptionRequest->id;
}

foreach ($finalInvestors as $inv) {
    UserAccess::updateOrCreate(
        ['user_id' => $userId, 'investor_id' => $inv->id],
        [
            'company_id' => $inv->company_id,
            'status' => 'pending',
            'start_date' => now(),
            'end_date' => now()->addDays(360),
            'subscription_request_id' => $subscriptionRequestId
        ]
    );
}


    $inserted = $finalInvestors->count();
    $msg = $inserted < $data_no
        ? "Assigned {$inserted} new investors (not enough unique records available to reach {$data_no})."
        : "Assigned {$inserted} new investors as requested.";

    return redirect()->route('home')->with('success', $msg);
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



// public function sectorintresteddata(Request $request)
// {
//     Log::info('SectorInterested Request:', $request->all());

//     $sectors            = (array) $request->input('sector', []);
//     $locations          = (array) $request->input('location', []);
//     $investment_sizes   = (array) $request->input('investment_size', []);
//     $investment_tenures = (array) $request->input('investment_tenure', []);
//     $investor_types     = (array) $request->input('investor_type', []);

//     $userId = auth()->id();

//     $subscriptionRequest = SubscriptionRequest::where('user_id', $userId)
//         ->latest()
//         ->first();
//     $data_no = $subscriptionRequest ? $subscriptionRequest->data_no : 0;

//     // 🔹 Normalize keywords helper
//     $toKeywords = function (array $values): array {
//         $stopwords = ['and', 'or', 'the', 'of', 'in', 'on', 'for', 'to', 'a', 'an'];
//         $all = [];
//         foreach ($values as $v) {
//             $v = strtolower($v);
//             $v = preg_replace('/[^a-z0-9 ]+/i', ' ', $v);
//             $parts = array_filter(explode(' ', preg_replace('/\s+/', ' ', trim($v))));
//             foreach ($parts as $p) {
//                 if (strlen($p) >= 2 && !in_array($p, $stopwords)) {
//                     $all[] = $p;
//                 }
//             }
//         }
//         return array_values(array_unique($all));
//     };

//     $sectorKeywords   = $toKeywords($sectors);
//     $locationKeywords = $toKeywords($locations);

//     // 🔹 Get all investors
//     $investors = Investor::with('investmentDetails')->get();

//     // 🔹 Step 1: Match sectors/locations
//     $sectorMatchedInvestors = $investors->filter(function ($inv) use ($sectorKeywords, $locationKeywords, $sectors) {
//         $originalSector = strtolower($inv->sectors_preferred ?? '');
//         $originalAddr   = strtolower($inv->address ?? '');

//         // Tokenize sectors
//         $normalized = strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $inv->sectors_preferred ?? ''));
//         $dbTokens = array_filter(explode(' ', preg_replace('/\s+/', ' ', $normalized)));

//         $matches = array_intersect($sectorKeywords, $dbTokens);

//         // Log every investor for debugging
//         Log::info('Sector Match Debug', [
//             'searched_input'      => $sectors,
//             'normalized_keywords' => $sectorKeywords,
//             'db_sector_original'  => $inv->sectors_preferred,
//             'db_sector_normalized'=> implode(' ', $dbTokens),
//             'matched_keywords'    => array_values($matches),
//             'investor_id'         => $inv->id,
//             'company_id'          => $inv->company_id,
//         ]);

//         // Sector OR location match
//         $sectorMatch   = !empty($matches);
//         $locationMatch = false;
//         foreach ($locationKeywords as $word) {
//             if (str_contains($originalAddr, $word)) {
//                 $locationMatch = true; break;
//             }
//         }

//         return $sectorMatch || $locationMatch;
//     });

//     // 🔹 Step 2: Apply investment filters
//     $applyInvestmentFilters = !empty($investment_sizes) || !empty($investment_tenures) || !empty($investor_types);

//     $fullyFilteredInvestors = $sectorMatchedInvestors->filter(function ($inv) use (
//         $applyInvestmentFilters, $investment_sizes, $investment_tenures, $investor_types
//     ) {
//         if (!$applyInvestmentFilters) return true;

//         $details = $inv->investmentDetails;
//         if (!$details) return false;
//         $match = false;

//         // Investment size
//         if (!empty($investment_sizes) && !$match) {
//             $dbSize = $this->parseInvestmentSizeToNumber($details->investment_size ?? '');
//             foreach ($investment_sizes as $range) {
//                 if ($range === '<1000000' && $dbSize < 1000000) { $match = true; break; }
//                 if ($range === '1000000-5000000' && $dbSize >= 1000000 && $dbSize <= 5000000) { $match = true; break; }
//                 if ($range === '5000000-10000000' && $dbSize > 5000000 && $dbSize <= 10000000) { $match = true; break; }
//                 if ($range === '>10000000' && $dbSize > 10000000) { $match = true; break; }
//             }
//         }

//         // Investment tenure
//         if (!empty($investment_tenures) && !$match) {
//             $normalizedTenure = $this->normalizeTenure($details->investment_tenure ?? '');
//             foreach ($investment_tenures as $selectedTenure) {
//                 if ($this->isOverlappingTenure($selectedTenure, $normalizedTenure)) {
//                     $match = true; break;
//                 }
//             }
//         }

//         // Investor type
//         if (!empty($investor_types) && !$match) {
//             $dbType = strtolower($details->investor_type ?? '');
//             foreach ($investor_types as $type) {
//                 if (str_contains($dbType, strtolower($type))) {
//                     $match = true; break;
//                 }
//             }
//         }

//         return $match;
//     });

//     // 🔹 Limit final selection
//     $fullyFilteredInvestors = $fullyFilteredInvestors->take($data_no);

//     // 🔹 Insert only matched investors
//     foreach ($fullyFilteredInvestors as $inv) {
//         UserAccess::firstOrCreate(
//             ['user_id' => $userId, 'investor_id' => $inv->id],
//             [
//                 'company_id' => $inv->company_id,
//                 'status'     => 'pending',
//                 'granted_by_user_id' => null,
//                 'start_date' => now(),
//                 'end_date'   => now()->addDays(360),
//             ]
//         );
//     }

//     // 🔹 Fill randoms if needed
//     $required = max(0, $data_no - $fullyFilteredInvestors->count());
//     if ($required > 0) {
//         $extra = Investor::whereNotIn('id', $fullyFilteredInvestors->pluck('id'))
//             ->whereNotIn('id', UserAccess::where('user_id', $userId)->pluck('investor_id'))
//             ->inRandomOrder()
//             ->take($required)
//             ->get();

//         foreach ($extra as $inv) {
//             UserAccess::firstOrCreate(
//                 ['user_id' => $userId, 'investor_id' => $inv->id],
//                 [
//                     'company_id' => $inv->company_id,
//                     'status'     => 'pending',
//                     'granted_by_user_id' => null,
//                     'start_date' => now(),
//                     'end_date'   => now()->addDays(360),
//                 ]
//             );
//         }
//     }

//     return redirect()->route('home')->with('success', 'Your subscription will be activated soon.');
// }
 



}