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
use App\Exports\InvestorsExport;
use App\Models\LocationDetail;
class ExcelUploadController extends Controller
{





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





    // public function downloaddataofInvestorExcel1(Request $request)
    // {
    //     // $investors=Investor::all();
    //     // $contactDetails=ContactDetails::all();
    //     // $guidanceNeed=GuidanceNeed::all();
    //     // $investmentDetail=InvestmentDetail::all();
    //     // $locationDetail=LocationDetail::all();
    //     // $previousInvestment=PreviousInvestment::all();
    //     // $publicLink=PublicLink::all();
    //     // $referral=Referral::all();
    //     // $investorAddress=InvestorAddress::all();

    //     $investors=Investor::with([
    //         'contactDetails',
    //         'guidanceNeeds',
    //         'investmentDetails',
    //         // 'locationDetail',
    //         'previousInvestments',
    //         'publicLinks',
    //         'referrals',
    //         'investorAddresses',
    //     ])->get();
    //     $num=0;
    //     $data=[];
    //     foreach($investors as $investor)
    //     {
    //         // $id=$investor->id;
    //         // $investorData=$investor->where('id',$id)->first();
    //         // $contactDetailsData=$contactDetails->where('investor_id',$id)->first();
    //         // $guidanceNeedData=$guidanceNeed->where('investor_id',$id)->first();
    //         // $investmentDetailData=$investmentDetail->where('investor_id',$id)->first();
    //         // $locationDetailData=$locationDetail->where('investor_id',$id)->first();
    //         // $previousInvestmentData=$previousInvestment->where('investor_id',$id)->first();
    //         // $publicLinkData=$publicLink->where('investor_id',$id);
    //         // $referralData=$referral->where('investor_id',$id)->first();
    //         // $investorAddressData=$investorAddress->where('investor_id',$id)->first();

            
    //         $num++;
    //         $datanew=[
    //             // "ID"=>$num,
    //             // "Name"=>$investorData->investor_name ?? 'N/A',
    //             // "Group"=>$investmentDetailData->investor_type ?? 'N/A',
    //             // "Address"=>$investorData->address ?? 'N/A',
    //             // "Country"=>$investorAddressData->country ?? 'N/A',
    //             // "State"=>$investorAddressData->state ?? 'N/A',
    //             // "City"=>$investorAddressData->city ?? 'N/A',
    //             // "Zip Code"=>$investorAddressData->zip_code ?? 'N/A',
    //             // "Mobile"=>$contactDetailsData->concerned_person_phone ?? 'N/A',
    //             // "Email"=>$contactDetailsData->email ?? 'N/A',
    //             // "Ticket Size"=>$contactDetailsData->investment_size ?? 'N/A',
    //             // "Investment Stage"=>$investmentDetailData->investor_type ?? 'N/A',
    //             // "Sectors Interested"=>$investorData->sectors_preferred ?? 'N/A',
    //             // "Investment Time Horizon"=>$investorData->investment_tenure ?? 'N/A',
    //             // "Website"=>$publicLinkData->where('link_description', 'Website')->first()->url ?? '',
    //             // "Linkedin"=>$publicLinkData->where('link_description', 'Linkedin')->first()->url ?? '',
    //             // "Twitter"=>$publicLinkData->where('link_description', 'Twitter')->first()->url ?? '',
    //             // "invest_in"=>$investmentDetailData->invest_in ?? 'N/A',
    //             // "concerned_person_name"=>$contactDetailsData->concerned_person_name ?? 'N/A',
    //             // "concerned_person_designation"=>$contactDetailsData->concerned_person_designation ?? 'N/A',
    //             // "guidance_needed"=>$guidanceNeedData->guidanceNeedData ?? 'N/A',
    //             // "other_guidance"=>$guidanceNeedData->other_guidance ?? 'N/A',
    //             // "previous_investment_year"=>$previousInvestmentData->previous_investment_year ?? 'N/A',
    //             // "previous_investment_company"=>$previousInvestmentData->previous_investment_company ?? 'N/A',
    //             // "sector"=>$previousInvestmentData->sector ?? 'N/A',
    //             // "referral_source"=>$previousInvestmentData->referral_source ?? 'N/A',
    //             "ID"=>$num,
    //             "Name"=>$investor->investor_name ?? 'N/A',
    //             "Group"=>$investor->investor_type ?? 'N/A',
    //             "Address"=>$investor->address ?? 'N/A',
    //             "Country"=>$investor->country ?? 'N/A',
    //             "State"=>$investor->state ?? 'N/A',
    //             "City"=>$investor->city ?? 'N/A',
    //             "Zip Code"=>$investor->zip_code ?? 'N/A',
    //             "Mobile"=>$investor->concerned_person_phone ?? 'N/A',
    //             "Email"=>$investor->email ?? 'N/A',
    //             "Ticket Size"=>$investor->investment_size ?? 'N/A',
    //             "Investment Stage"=>$investor->investor_type ?? 'N/A',
    //             "Sectors Interested"=>$investor->sectors_preferred ?? 'N/A',
    //             "Investment Time Horizon"=>$investor->investment_tenure ?? 'N/A',
    //             "Website"=>$investor->where('link_description', 'Website')->first()->url ?? '',
    //             "Linkedin"=>$investor->where('link_description', 'Linkedin')->first()->url ?? '',
    //             "Twitter"=>$investor->where('link_description', 'Twitter')->first()->url ?? '',
    //             "invest_in"=>$investor->invest_in ?? 'N/A',
    //             "concerned_person_name"=>$investor->concerned_person_name ?? 'N/A',
    //             "concerned_person_designation"=>$investor->concerned_person_designation ?? 'N/A',
    //             "guidance_needed"=>$investor->guidanceNeedData ?? 'N/A',
    //             "other_guidance"=>$investor->other_guidance ?? 'N/A',
    //             "previous_investment_year"=>$investor->previous_investment_year ?? 'N/A',
    //             "previous_investment_company"=>$investor->previous_investment_company ?? 'N/A',
    //             "sector"=>$investor->sector ?? 'N/A',
    //             "referral_source"=>$investor->referral_source ?? 'N/A',
    //         ];            

    //         $data[] = $datanew;
    //     }


    //         $format=$request->input('format','xlsx');

    //         $validFormat = ['xlsx','xls','csv','pdf'];

    //         if(!in_array($format,$validFormat)){
    //             return response()->json([
    //                 'message' => 'Invalid format specified .Valid format are: xlsx,xls,csv,pdf.',
    //             ],400);
    //         }

    //         $fileName = 'Investor_data.'.$format;


    //         $formatMap = 
    //         [
    //             'xlsx'=> \Maatwebsite\Excel\Excel::XLSX,
    //             'xls'=> \Maatwebsite\Excel\Excel::XLS,
    //             'csv'=> \Maatwebsite\Excel\Excel::CSV,
    //             'pdf'=> \Maatwebsite\Excel\Excel::DOMPDF,
    //         ];

            
    //         return Excel::download(new InvestorsExport($data),$fileName,$formatMap[$format]);


        
    // }
    public function downloaddataofInvestorExcel(Request $request)
    {


        $investors=Investor::with([
            'contactDetails',
            'guidanceNeeds',
            'investmentDetails',
            // 'locationDetail',
            'previousInvestments',
            // 'publicLinks',
            'publicLinks' => function ($query){
                $query->whereIn('link_description',['Website','Linkedin','Twitter']);
            },
            // 'publicLinks' => function ($query) {
            //     $query->whereIn('link_description', ['Website', 'Linkedin', 'Twitter']);
            // },
            'referrals',
            'investorAddresses',
        ])->get();
        $num=0;
        $data=[];
        $data[] =[
            "ID"=>"ID",
            "Name"=>"Name",
            "Group"=>"Group",
            "Address"=>"Address",
            "Country"=>"Country",
            "State"=>"State",
            "City"=>"City",
            "Zip Code"=>"Zip Code",
            "Mobile"=>"Mobile",
            "Email"=>"Email",
            "Ticket Size"=>"Ticket Size",
            "Investment Stage"=>"Investment Stage",
            "Sectors Interested"=>"Sectors Interested",
            "Investment Time Horizon"=>"Investment Time Horizon",
            "Website"=>"Website",
            "Linkedin"=>"Linkedin",
            "Twitter"=>"Twitter",
            "invest_in"=>"invest_in",
            "concerned_person_name"=>"concerned_person_name",
            "concerned_person_designation"=>"concerned_person_designation",
            "guidance_needed"=>"guidance_needed",
            "other_guidance"=>"other_guidance",
            "previous_investment_year"=>"previous_investment_year",
            "previous_investment_company"=>"previous_investment_company",
            "sector"=>"sector",
            "referral_source"=>"referral_source",
        ];
        foreach($investors as $investor)
        {
                  $num++;
            $datanew=[
              
                "ID"=>$num,
                "Name"=>$investor->investor_name ?? 'N/A',
                "Group"=>$investor->investmentDetails->investor_type ?? 'N/A',
                "Address"=>$investor->address ?? 'N/A',
                "Country"=>optional($investor->investorAddresses->first())->country ?? 'N/A',
                "State"=>optional($investor->investorAddresses->first())->state ?? 'N/A',
                "City"=>optional($investor->investorAddresses->first())->city ?? 'N/A',
                "Zip Code"=>optional($investor->investorAddresses->first())->zip_code ?? 'N/A',
                "Mobile"=>optional($investor->contactDetails)->concerned_person_phone ?? 'N/A',
                "Email"=>optional($investor->contactDetails)->email ?? 'N/A',
                "Ticket Size"=>optional($investor->investmentDetails)->investment_size ?? 'N/A',
                "Investment Stage"=>optional($investor->investmentDetails)->investor_type ?? 'N/A',
                "Sectors Interested"=>$investor->sectors_preferred ?? 'N/A',
                "Investment Time Horizon"=>optional($investor->investmentDetails)->investment_tenure ?? 'N/A',
                "Website"=>$investor->publicLinks->where('link_description', 'Website')->first()->url ?? '',
                "Linkedin"=>$investor->publicLinks->where('link_description', 'Linkedin')->first()->url ?? '',
                "Twitter"=>$investor->publicLinks->where('link_description', 'Twitter')->first()->url ?? '',
                "invest_in"=>optional($investor->investmentDetails)->invest_in ?? 'N/A',
                "concerned_person_name"=>optional($investor->contactDetails)->concerned_person_name ?? 'N/A',
                "concerned_person_designation"=>optional($investor->contactDetails)->concerned_person_designation ?? 'N/A',
                "guidance_needed"=>optional($investor->guidanceNeeds)->guidanceNeedData ?? 'N/A',
                "other_guidance"=>optional($investor->guidanceNeeds)->other_guidance ?? 'N/A',
                "previous_investment_year"=>optional($investor->previousInvestments->first())->previous_investment_year ?? 'N/A',
                "previous_investment_company"=>optional($investor->previousInvestments->first())->previous_investment_company ?? 'N/A',
                "sector"=>optional($investor->previousInvestments)->sector ?? 'N/A',
                "referral_source"=>optional($investor->referrals)->referral_source ?? 'N/A',
            ];            

            $data[] = $datanew;
        }


            $format=$request->input('format','xlsx');

            $validFormat = ['xlsx','xls','csv','pdf'];

            if(!in_array($format,$validFormat)){
                return response()->json([
                    'message' => 'Invalid format specified .Valid format are: xlsx,xls,csv,pdf.',
                ],400);
            }

            $fileName = 'Investor_data.'.$format;


            $formatMap = 
            [
                'xlsx'=> \Maatwebsite\Excel\Excel::XLSX,
                'xls'=> \Maatwebsite\Excel\Excel::XLS,
                'csv'=> \Maatwebsite\Excel\Excel::CSV,
                'pdf'=> \Maatwebsite\Excel\Excel::DOMPDF,
            ];

            
            return Excel::download(new InvestorsExport($data),$fileName,$formatMap[$format]);


        
    }
}



 









































































