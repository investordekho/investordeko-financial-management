<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionRequest;
use App\Models\Payment_detail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionRequestMail;
use App\Models\ServiceContact;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Mail\ResetPasswordMail;
use App\Mail\SubscriptionRequestApprovedMail;
class SubscriptionRequestController extends Controller
{
    //
    public function allrequests()
    {

        
        $subscriptionRequests = SubscriptionRequest::with(['user','paymentDetail'])->get();
        return view('allsubscriptionrequests', ['subscriptionRequests' => $subscriptionRequests]);
    }

    public function pendingrequests(Request $request)
    {
       
        $data = SubscriptionRequest::where('status' , 'pending')
            ->get();
        return view('pendingrequests', ['data' => $data]);
    }
    public function createsubscriptionrequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string',
            'reference_id' => 'nullable|string',
            'upi_id' => 'nullable|string',
            'plan_amount' => 'required|numeric',
            'no_of_data' => 'required|numeric',
            'screenshot' => 'required|image|max:2048', // <-- image file validation
        ]);

        $user = Auth::user();

        // Create new subscription request
        $subscriptionRequest = new SubscriptionRequest();
        $subscriptionRequest->user_id = $user->id;
        $subscriptionRequest->no_of_data = $request->input('no_of_data');
        $no_of_data = $request->input('no_of_data');
        $subscriptionRequest->plan = $no_of_data > 10 ? 499 : 999;
        $subscriptionRequest->plan_amount = $request->input('plan_amount');
        $subscriptionRequest->status = 'pending';
        $subscriptionRequest->created_at = now();
        $subscriptionRequest->updated_at = now();
        $subscriptionRequest->subscription_start = now(); // Set subscription start date


        if (!$subscriptionRequest->save()) {
            return back()->with('error', 'Failed to save subscription request.');
        }

        // Create new payment detail
        $paymentDetails = new Payment_detail();
        $paymentDetails->user_id = $user->id;
        $paymentDetails->subscription_id = $subscriptionRequest->id;
        $paymentDetails->payment_method = $request->input('payment_method');
        $paymentDetails->amount = $request->input('plan_amount');
        $paymentDetails->currency = "INR";
        $paymentDetails->transaction_id = $request->input('transaction_id');
        if($paymentDetails->payment_method == 'upi')
        {
            // $paymentDetails->upi_id = $request->input('upi_id');
            $paymentDetails->reference_id = $request->input('upi_id');;
        }
        else
        {
            // $paymentDetails->upi_id = null;
            $paymentDetails->reference_id = $request->input('reference_id');
        }
    
        $paymentDetails->phone = $request->input('phone');
        
        if ($request->hasFile('screenshot')) {
            $file = $request->file('screenshot');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('screenshots', $filename, 'public'); // Store in public disk
            $paymentDetails->screen_shot = $path;
        }
        
        $paymentDetails->created_at = now();
        $paymentDetails->updated_at = now();

    
        if (!$paymentDetails->save()) {
            return back()->with('error', 'Failed to save payment details.');
        }
        $subscriptionRequest->payment_detail_id = $paymentDetails->id; // Associate payment detail with subscription request
        $subscriptionRequest->save(); // Save the subscription request again to update the payment detail ID

    
        //send email to admin
        try{    
        Mail::to('investordekhopoojad@gmail.com')->send(new \App\Mail\SubscriptionRequestMail([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'payment_method' => $request->input('payment_method'),
                    'transaction_id' => $request->input('transaction_id'),
                    'reference_id' => $request->input('reference_id') ?? $request->input('upi_id'),
                    'plan_amount' => $request->input('plan_amount'),
                    'no_of_data' => $request->input('no_of_data'),
                ]));
        }
        catch (\Exception $e) {
            Log::error('Failed to send subscription request email: ' . $e->getMessage());
            return back()->with('error', 'Failed to send subscription request email.');
        }    
        
        // return redirect()->route('home')->with('success','Subscription Request Created Successfully!');
        // retun subscription2 this view
         return redirect()->route('subscription2')->with('success', 'Subscription request created successfully!');
    }

 
    public function updatesubScriptionRequest(Request $request)
    {
        // $isSubscripbed_data = Subscriber::where('user_id', Auth::user()->id)->first();

        $updat_data_id = $request->input('id');
        $SubscriptionRequest = SubscriptionRequest::find($update_data_id);
        if($SubscriptionRequest)
        {
            $SubscriptionRequest->status = $request->input('status');
            $SubscriptionRequest->no_of_data = $request->input('no_of_data');
            $no_of_data = $request->input('no_of_data');
            if($no_of_data > 10)
            {
                $SubscriptionRequest->plan = 499;
            }
            else
            {
                $SubscriptionRequest->plan = 999;
            }
            $SubscriptionRequest->plan_amount = $request->input('plan_amount');
            $SubscriptionRequest->subscription_start = now();
            // $SubscriptionRequest->subscription_end = $request->input('subscription_end');
            $SubscriptionRequest->created_at = now();
            $SubscriptionRequest->updated_at = now();
            $SubscriptionRequest->save();
            if($SubscriptionRequest->status == 'approved'){
                // $subscriber = Subscriber::where('user_id' , Auth::user()->id)->first();
                $subscriber = Subscriber::where('user_id', $subscriptionRequest->user_id)->first();
                if($subscriber)
                {
                    $subscriber->is_subscribed = 1;
                    $subscriber->subscription_start = $SubscriptionRequest->subscription_start;
                    // $subscriber->subscription_end = $SubscriptionRequest->subscription_end;
                    $subscriber->save();
                }
                else
                {
                    $subscriber = new Subscriber();
                    $subscriber->user_id = Auth::user()->id;
                    $subscriber->is_subscribed = 1;
                    $subscriber->subscription_start = $SubscriptionRequest->subscription_start;
                    // $subscriber->subscription_end = $SubscriptionRequest->subscription_end;
                    $subscriber->save();
                }
                //update user_accesses table status to approved
                DB::table('user_accesses')->where('user_id', $SubscriptionRequest->user_id)->update(['status' => 'approved']);
            }
            return redirect()->back()->with('success', 'Subscription request updated successfully!');
        }
    }
    // public function updatestatus(Request $request, $id)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'status' => 'required|string|in:approved,rejected,pending',
    //     ]);

    //     // Find the subscription request by ID
    //     $subscriptionRequest = SubscriptionRequest::find($id);

    //     if ($subscriptionRequest) {
    //         // Update the status of the subscription request
    //         $subscriptionRequest->status = $request->input('status');
    //         $subscriptionRequest->save();
    //         if($subscriptionRequest->status == 'approved'){
    //             // $subscriber = Subscriber::where('user_id' , Auth::user()->id)->first();
    //             $subscriber = Subscriber::where('user_id', $subscriptionRequest->user_id)->first();
    //             if($subscriber)
    //             {
    //                 $subscriber->is_subscribed = 1;
    //                 $subscriber->subscription_start = $subscriptionRequest->subscription_start;
    //                 // $subscriber->subscription_end = $subscriptionRequest->subscription_end;
    //                 $subscriber->save();
    //             }
    //             else
    //             {
    //                 $subscriber = new Subscriber();
    //                 $subscriber->user_id = Auth::user()->id;
    //                 $subscriber->is_subscribed = 1;
    //                 $subscriber->subscription_start = $subscriptionRequest->subscription_start;
    //                 // $subscriber->subscription_end = $subscriptionRequest->subscription_end;
    //                 $subscriber->save();
    //             }
    //         }
    //         // Redirect back with a success message
    //         return redirect()->back()->with('success', 'Subscription request status updated successfully!');
    //     } else {
    //         // Redirect back with an error message if the subscription request is not found
    //         return redirect()->back()->with('error', 'Subscription request not found!');
    //     }
    // }
    public function updatestatus(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'status' => 'required|string|in:approved,rejected,pending',
    ]);

    // Find the subscription request by ID
    $subscriptionRequest = SubscriptionRequest::find($id);

    if ($subscriptionRequest) {
        // Update the status
        $subscriptionRequest->status = $request->input('status');
        $subscriptionRequest->save();

        // ✅ Check and log if approved
        if ($subscriptionRequest->status === 'approved') {
            Log::info('Subscription approved for user ID: ' . $subscriptionRequest->user_id);

            // ✅ Update or create subscriber record
            $subscriber = Subscriber::where('user_id', $subscriptionRequest->user_id)->first();

            if ($subscriber) {
                $subscriber->is_subscribed = 1;
                $subscriber->subscription_start = $subscriptionRequest->subscription_start;
                $subscriber->save();

                Log::info('Existing subscriber updated', [
                    'user_id' => $subscriber->user_id,
                    'is_subscribed' => $subscriber->is_subscribed,
                ]);
            } else {
                $subscriber = new Subscriber();
                $subscriber->user_id = $subscriptionRequest->user_id;
                $subscriber->is_subscribed = 1;
                $subscriber->subscription_start = $subscriptionRequest->subscription_start;
                $subscriber->save();

                Log::info('New subscriber created', [
                    'user_id' => $subscriber->user_id,
                    'is_subscribed' => $subscriber->is_subscribed,
                ]);
            }
            // ✅ Send email notification to the user
           $user = User::find($subscriptionRequest->user_id);
            Log::info('Sending subscription approval email to user Name: ' .  $user->name);

            $data = [
                'name' => $user->name,
                'plan_name' => $subscriptionRequest->no_of_data ?? 'N/A',
                'amount' => $subscriptionRequest->plan_amount ?? '0',
                'validity' => '1 Year',
            ];

            try {
                Mail::to($user->email)->send(new SubscriptionRequestApprovedMail([
                'name' => $user->name,
                'plan_name' => $subscriptionRequest->no_of_data ?? 'N/A',
                'amount' => $subscriptionRequest->plan_amount ?? '0',
                'validity' => '1 Year'
                ]));

                Log::info('Subscription approval email sent to user ID: ' . $user->id);
            } catch (\Exception $e) {
                Log::error('Failed to send subscription approval email: ' . $e->getMessage());
            } 
            $SubscriptionRequest = SubscriptionRequest::find($id);
                    //update user_accesses table status to approved
                DB::table('user_accesses')->where('subscription_request_id', $SubscriptionRequest->id)->update(['status' => 'approved']);  
        }
        else if ($subscriptionRequest->status === 'rejected') {
            Log::info('Subscription rejected for user ID: ' . $subscriptionRequest->user_id);
            DB::table('user_accesses')->where('subscription_request_id', $subscriptionRequest->id)->update(['status' => 'rejected']);
            // Optionally, you can add logic to handle rejection, such as notifying the user
        }

        return redirect()->back()->with('success', 'Subscription request status updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Subscription request not found!');
    }
}

}
 