<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\ContactDetails;
use App\Models\PublicLink;
use App\Models\InvestmentDetail;
use App\Models\PreviousInvestment;
use App\Models\Referral;
use App\Models\GuidanceNeed;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InvestorImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\InvestorAddress;
class ExcelUploadController extends Controller
{



// public function exceluploadinvestor(Request $request) 
// {
//     $validator = Validator::make($request->all(), [
//         'file' => 'required|mimes:xlsx,xls,csv',
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'File validation failed.',
//             'errors' => $validator->errors()
//         ], 422);
//     }

//     if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
//         return response()->json(['success' => false, 'message' => 'Invalid or missing file'], 400);
//     }

//     try {
//         $file = $request->file('file');
//         $data = Excel::toCollection(null, $file);

//         if ($data->isEmpty() || $data[0]->isEmpty()) {
//             return response()->json(['success' => false, 'message' => 'No valid data found in the Excel file.'], 400);
//         }

//         // Define required columns
//         $requiredColumns = [
//             'Name', 'Address', 'Country', 'State', 'City', 'Zip Code',
//             'Mobile', 'Email', 'Ticket size', 'Investment Stage', 
//             'Sectors Interested', 'Investment Time Horizon',
//             'Website', 'Linkedin', 'Twitter'
//         ];

//         // Fetch header row and normalize it
//         $headerRow = $data[0]->first()->toArray();
//         $normalizedHeaders = array_map(fn($header) => strtolower(trim($header)), $headerRow);
//         $normalizedRequiredColumns = array_map(fn($col) => strtolower(trim($col)), $requiredColumns);

//         Log::info('Excel Headers:', $normalizedHeaders);
//         Log::info('Expected Headers:', $normalizedRequiredColumns);

//         // Ensure headers match
//         if (array_diff($normalizedRequiredColumns, $normalizedHeaders)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Column names do not match the expected format.'
//             ], 400);
//         }

//         // Process each row (excluding header)
//         foreach ($data[0]->slice(1) as $row) {
//             try {
//                 DB::beginTransaction();

//                 // Fetch row values explicitly
//                 $rowValues = array_values($row->toArray());

//                 // Assign values to variables using index positions
//                 $investorData = [
//                     'investor_name' => trim($rowValues[array_search('name', $normalizedHeaders)] ?? 'Unknown Investor'),
//                     'address' => trim($rowValues[array_search('address', $normalizedHeaders)] ?? 'Not Provided'),
//                     'sectors_preferred' => trim($rowValues[array_search('sectors interested', $normalizedHeaders)] ?? 'Not Specified'),
//                     'user_id' => auth()->id() ?? 7,
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ];

//                 Log::info('Processing Investor:', $investorData);

//                 // Store Investor
//                 $investor = Investor::firstOrCreate(
//                     ['investor_name' => $investorData['investor_name']],
//                     $investorData
//                 );

//                 if (!$investor->id) {
//                     Log::error('Investor not created:', $investorData);
//                     continue;
//                 }

//                 // Store Contact Details
//                 $mobile = trim($rowValues[array_search('mobile', $normalizedHeaders)] ?? '');
//                 if (!empty($mobile)) {
//                     foreach (explode(',', $mobile) as $number) {
//                         ContactDetails::firstOrCreate(
//                             ['investors_id' => $investor->id, 'concerned_person_phone' => trim($number)],
//                             ['concerned_person_name' => $investorData['investor_name'],
//                             'concerned_person_designation' => $row['designation'] ?? 'N/A', // Ensure this is included
//                             'email' => trim($rowValues[array_search('email', $normalizedHeaders)] ?? null)]
//                         );
//                     }
//                 }

//                 // Store Public Links
//                 foreach (['website', 'linkedin', 'twitter'] as $key) {
//                     $url = trim($rowValues[array_search($key, $normalizedHeaders)] ?? '');
//                     if (!empty($url)) {
//                         PublicLink::firstOrCreate(
//                             ['investor_id' => $investor->id, 'url' => $url],
//                             ['link_description' => ucfirst($key)]
//                         );
//                     }
//                 }

//                 // Store Address
//                 $addressData = [
//                     'country' => trim($rowValues[array_search('country', $normalizedHeaders)] ?? ''),
//                     'state' => trim($rowValues[array_search('state', $normalizedHeaders)] ?? ''),
//                     'city' => trim($rowValues[array_search('city', $normalizedHeaders)] ?? ''),
//                     'zip_code' => trim($rowValues[array_search('zip code', $normalizedHeaders)] ?? ''),
//                 ];
//                 if (!empty($addressData['country']) || !empty($addressData['state']) || !empty($addressData['city'])) {
//                     InvestorAddress::firstOrCreate(['investor_id' => $investor->id], $addressData);
//                 }

//                 // Store Investment Details
//                 $investmentData = [
//                     'investment_size' => trim($rowValues[array_search('ticket size', $normalizedHeaders)] ?? ''),
//                     'investor_type' => trim($rowValues[array_search('investment stage', $normalizedHeaders)] ?? ''),
//                     'investment_tenure' => trim($rowValues[array_search('investment time horizon', $normalizedHeaders)] ?? ''),
//                 ];
//                 if (!empty($investmentData['investment_size']) || !empty($investmentData['investor_type']) || !empty($investmentData['investment_tenure'])) {
//                     InvestmentDetail::firstOrCreate(['investor_id' => $investor->id], $investmentData);
//                 }

//                 DB::commit();
//             } catch (\Exception $e) {
//                 DB::rollBack();
//                 Log::error('Row processing failed: ' . $e->getMessage(), ['row' => $rowValues]);
//                 continue;
//             }
//         }

//         return response()->json([
//             'success' => true,
//             'message' => 'Investor profiles created successfully'
//         ], 200);

//     } catch (\Exception $e) {
//         Log::error('Excel upload error: ' . $e->getMessage());
//         return response()->json(['success' => false, 'message' => 'Error uploading data: ' . $e->getMessage()], 500);
//     }
// }




    public function exceluploadinvestor(Request $request)  
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'File validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return response()->json(['success' => false, 'message' => 'Invalid or missing file'], 400);
        }

        try {
            $file = $request->file('file');
            $data = Excel::toCollection(null, $file);

            if ($data->isEmpty() || $data[0]->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No valid data found in the Excel file.'], 400);
            }

            $columnMapping = [
                'Name' => 'investor_name',
                'Address' => 'address',
                'Country' => 'country',
                'State' => 'state',
                'City' => 'city',
                'Zip Code' => 'zip_code',
                'Mobile' => 'mobile',
                'Email' => 'email',
                'Ticket size' => 'investment_size',
                'Investment Stage' => 'investor_type',
                'Sectors Interested' => 'sectors_preferred',
                'Investment Time Horizon' => 'investment_tenure',
                'Website' => 'website',
                'Linkedin' => 'linkedin',
                'Twitter' => 'twitter'
            ];

            $headerRow = $data[0]->first()->toArray();
            $normalizedHeaders = array_map(fn($header) => strtolower(trim($header)), $headerRow);
            
            $headerMap = [];
            foreach ($columnMapping as $excelColumn => $dbColumn) {
                $normalizedExcelColumn = strtolower(trim($excelColumn));
                if (in_array($normalizedExcelColumn, $normalizedHeaders)) {
                    $headerMap[$dbColumn] = array_search($normalizedExcelColumn, $normalizedHeaders);
                }
            }

            $errors = [];
            $rowIndex = 1;

            foreach ($data[0]->slice(1) as $row) {
                $rowIndex++; 
                try {
                    set_time_limit(300); // Prevent timeout issues
                    DB::connection()->disableQueryLog(); // Speeds up processing
                    // DB::beginTransaction();

                    $rowValues = $row->toArray();
                    $getValue = fn($dbColumn) => isset($headerMap[$dbColumn]) ? trim($rowValues[$headerMap[$dbColumn]] ?? '') : '';

                    // Assign values dynamically with random fallback values
                    $investorData = [
                        // 'investor_name' => $getValue('investor_name') ?: $this->getRandomValue('name'),
                        // 'address' => $getValue('address') ?: $this->getRandomValue('address'),
                        // 'sectors_preferred' => $getValue('sectors_preferred') ?: $this->getRandomValue('sector'),'Not Specified'
                        'investor_name' => $getValue('investor_name') ?: 'Not Specified',
                        'address' => $getValue('address') ?: 'Not Specified',
                        'sectors_preferred' => $getValue('sectors_preferred') ?: 'Not Specified',
                        'user_id' => auth()->id() ?? 7,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $investor = Investor::firstOrCreate(
                        ['investor_name' => $investorData['investor_name']],
                        $investorData
                    );

                    if (!$investor->id) {
                        $errors[] = [
                            'row' => $rowIndex,
                            'error' => "Failed to create investor record."
                        ];
                        DB::rollBack();
                        continue;
                    }

                    // Store Contact Details
                    // $mobile = $getValue('mobile') ?: $this->getRandomValue('mobile');
                    $mobile = $getValue('mobile') ?: "000000000";
                    // foreach (explode(',', $mobile) as $number) {
                    //     ContactDetails::firstOrCreate(
                    //         ['investors_id' => $investor->id, 'concerned_person_phone' => trim($number)],
                    //         [
                    //             'concerned_person_name' => $investorData['investor_name'],
                    //             'concerned_person_designation' => 'N/A',
                    //             'email' => $getValue('email') ?: $this->getRandomValue('email')
                    //         ]
                    //     );
                    // }
                    $mobileNumbers = explode(',', $getValue('mobile')); // Split numbers by comma

                    foreach ($mobileNumbers as $number) {
                        $cleanedNumber = preg_replace('/[^0-9+]/', '', trim($number)); // Remove unwanted characters

                        if (!empty($cleanedNumber)) { // Ensure it's not an empty value
                            ContactDetails::firstOrCreate(
                                [
                                    'investors_id' => $investor->id,
                                    'concerned_person_phone' => $cleanedNumber
                                ],
                                [
                                    'concerned_person_name' => $investorData['investor_name'],
                                    'concerned_person_designation' => 'N/A',
                                    'email' => $getValue('email') ?: 'Not Provided' // Default if missing
                                ]
                            );
                        }
                    }
 
                    // Store Public Links
                    foreach (['website', 'linkedin', 'twitter'] as $dbColumn) {
                        // $url = $getValue($dbColumn) ?: $this->getRandomValue('url');
                        $url =  $getValue($dbColumn) ?: 'Not Provided';
                        PublicLink::firstOrCreate(
                            ['investor_id' => $investor->id, 'url' => $url],
                            ['link_description' => ucfirst($dbColumn)]
                        );
                    }

                    // Store Address
                    $addressData = [
                        // 'country' => $getValue('country') ?: $this->getRandomValue('country'),
                        // 'state' => $getValue('state') ?: $this->getRandomValue('state'),
                        // 'city' => $getValue('city') ?: $this->getRandomValue('city'),
                        // 'zip_code' => $getValue('zip_code') ?: mt_rand(10000, 99999),
                        'country' => $getValue('country') ?: 'Not Specified',
                        'state' => $getValue('state') ?: 'Not Specified',
                        'city' => $getValue('city') ?: 'Not Specified',
                        'zip_code' => $getValue('zip_code') ?: 0,
                    ];
                    InvestorAddress::firstOrCreate(['investor_id' => $investor->id], $addressData);

                    // Store Investment Details
                    $investmentData = [
                        // 'investment_size' => $getValue('investment_size') ?: mt_rand(100000, 5000000),
                        // 'investor_type' => $getValue('investor_type') ?: $this->getRandomValue('investor_type'),
                        // 'investment_tenure' => $getValue('investment_tenure') ?: mt_rand(1, 10) . ' years',
                        'investment_size' => $getValue('investment_size') ?: 0,
                        'investor_type' => $getValue('investor_type') ?: 'Not Specified',
                        'investment_tenure' => $getValue('investment_tenure') ?: 'Not Specified years',
                    ];
                    InvestmentDetail::firstOrCreate(['investor_id' => $investor->id], $investmentData);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $errors[] = [
                        'row' => $rowIndex,
                        'error' => "Processing error: " . $e->getMessage()
                    ];
                    continue;
                }
            }

            if (!empty($errors)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Some records could not be uploaded. Check errors for details.',
                    'errors' => $errors
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Investor profiles created successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Excel upload error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error uploading data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Generate random placeholder values
     */
    private function getRandomValue($type)
    {
        switch ($type) {
            case 'name':
                // return 'Investor-' . Str::random(6);
                return 'Unknown Investor';
            case 'address':
                // return 'Address-' . Str::random(8);
                return 'Not Provided';
            case 'sector':
                // return 'Sector-' . Str::random(5);
                return 'Not Defined';
            case 'mobile':
                return '+1' . mt_rand(1000000000, 9999999999);
            case 'email':
                return 'user' . mt_rand(1000, 9999) . '@example.com';
            case 'url':
                return 'https://example' . mt_rand(1, 100) . '.com';
            case 'country':
                // return 'Country-' . Str::random(5);
                return 'Not Specified';
            case 'state':
                // return 'State-' . Str::random(5);
                return 'Not Specified';
            case 'city':
                // return 'City-' . Str::random(5);
                return 'Not Specified';
            case 'investor_type':
                // return 'Type-' . Str::random(4);
                return 'Not Specified';
            default:
                return 'Unknown-' . Str::random(6);
        }
    }





// public function store(Request $request)
// {
//     // Validate the request
//     $request->validate([
//         'investor_name' => 'required|string|max:255',
//         'sectors_preferred' => 'required|array', // Make sure this is an array
//         'Address' => 'required|string',
//         'concerned_person_name' => 'required|string',
//         'concerned_person_designation' => 'required|string',
//         'concerned_person_phone' => 'required|string|max:10',
//         'email' => 'required|email',
//         'public_links.*' => 'required|url',
//         'link_descriptions.*' => 'required|string',
//         'invest_in' => 'required|string',
//         'investor_type' => 'required|string',
//         'investment_size' => 'required|string',
//         'investment_tenure' => 'required|string',
//         'previous_investment_year.*' => 'required|integer',
//         'previous_investment_company.*' => 'required|string',
//         'sector.*' => 'required|string',
//         'referral_source' => 'required|string',
//         'guidance_needed' => 'required|array',
//         'investor_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
//     ]);

//     // Handle file upload for investor profile
//     $filePath = null;  // Initialize as null
//     if ($request->hasFile('investor_profile')) {
//         // Store the file and get the path
//         $filePath = $request->file('investor_profile')->store('investor_profiles', 'public');
//     }

//     // Convert the sectors array to a comma-separated string
//     $sectors_preferred = implode(',', $request->input('sectors_preferred'));  // Convert array to string

//     // Store the investor profile
//     $investor = Investor::create([
//         'user_id' => Auth::id(),  // Authenticated user's ID
//         'investor_name' => $request->investor_name,
//         'address' => $request->address,
//         'investor_profile' => $filePath,  // Use the uploaded file path
//         'sectors_preferred' => $sectors_preferred,  // Save as comma-separated string
//     ]);

//     // Store contact details
//     ContactDetails::create([
//         'investor_id' => $investor->id,
//         'concerned_person_name' => $request->concerned_person_name,
//         'concerned_person_designation' => $request->concerned_person_designation,
//         'concerned_person_phone' => $request->concerned_person_phone,
//         'email' => $request->email,
//     ]);

//     // Store public links
//     if ($request->has('public_links')) {
//         foreach ($request->public_links as $index => $url) {
//             PublicLink::create([
//                 'investor_id' => $investor->id,
//                 'url' => $url,
//                 'link_description' => $request->link_descriptions[$index],
//             ]);
//         }
//     }

//     // Store investment details
//     InvestmentDetail::create([
//         'investor_id' => $investor->id,
//         'invest_in' => $request->invest_in,
//         'investor_type' => $request->investor_type,
//         'investment_size' => $request->investment_size,
//         'investment_tenure' => $request->investment_tenure,
//     ]);

//     // Store previous investments
//     if ($request->has('previous_investment_year')) {
//         foreach ($request->previous_investment_year as $index => $year) {
//             PreviousInvestment::create([
//                 'investor_id' => $investor->id,
//                 'previous_investment_year' => $year,
//                 'previous_investment_company' => $request->previous_investment_company[$index],
//                 'sector' => $request->sector[$index],
//             ]);
//         }
//     }

//     // Store referral
//     Referral::create([
//         'investor_id' => $investor->id,
//         'referral_source' => $request->referral_source,
//     ]);

//     if ($request->has('guidance_needed')) {
//         foreach ($request->guidance_needed as $guidance) {
//             GuidanceNeed::create([
//                 'investor_id' => $investor->id,
//                 'guidance_needed' => is_array($guidance) ? implode(',', $guidance) : $guidance,  // Convert array to comma-separated string if needed
//                 'other_guidance' => $request->other_guidance ?? null,
//             ]);
//         }
//     }
    

//     // Update the user's profile to indicate the form has been filled
//     $user = Auth::user();
//     $user->form_filled = true; // Assuming this column exists in your users table
//     $user->save();

//     // Redirect the user to the investor dashboard with a success message
//     return redirect()->route('investor.dashboard')->with('success_message', 'Investor profile created successfully!');
// }


}

 









































































