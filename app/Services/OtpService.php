<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class OtpService
{
    // protected $apiKey;

    // public function __construct()
    // {
    //     $this->apiKey = env('FAST2SMS_API_KEY'); // use .env for safety
    // }





//     public function sendOtp($phone, $otp)
// {
//     $sender_id = 'FSTSMS'; // This must be DLT-approved OR use 'SMSIND' with route 'q' for testing
//     $message = "Your OTP code is $otp";
//     $route = 'q'; // ✅ use 'q' for testing instead of 'dlt'
    

//     $response = Http::asForm()->withHeaders([
//         'authorization' => $this->apiKey
//     ])->post('https://www.fast2sms.com/dev/bulkV2', [
//         'sender_id' => $sender_id,
//         'message' => $message,
//         'route' => $route,
//         'numbers' => $phone
//     ]);

//     // Log for debug
//     \Log::info('Fast2SMS Response: ' . json_encode($response->json()));

//     return $response->json();
// }

  
}
