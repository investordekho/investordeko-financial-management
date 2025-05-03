<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionRequest;
use App\Models\payment_detail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Subscriber;
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
            $paymentDetails->upi_id = $request->input('upi_id');
            $paymentDetails->reference_id = null;
        }
        else
        {
            $paymentDetails->upi_id = null;
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

    
        return redirect()->route('home')->with('success','Subscription Request Created Successfully!');
        
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
                $subscriber = Subscriber::where('user_id' , Auth::user()->id)->first();
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
            }
            return redirect()->back()->with('success', 'Subscription request updated successfully!');
        }
    }
    public function updatestatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|string|in:approved,rejected,pending',
        ]);

        // Find the subscription request by ID
        $subscriptionRequest = SubscriptionRequest::find($id);

        if ($subscriptionRequest) {
            // Update the status of the subscription request
            $subscriptionRequest->status = $request->input('status');
            $subscriptionRequest->save();
            if($subscriptionRequest->status == 'approved'){
                $subscriber = Subscriber::where('user_id' , Auth::user()->id)->first();
                if($subscriber)
                {
                    $subscriber->is_subscribed = 1;
                    $subscriber->subscription_start = $subscriptionRequest->subscription_start;
                    // $subscriber->subscription_end = $subscriptionRequest->subscription_end;
                    $subscriber->save();
                }
                else
                {
                    $subscriber = new Subscriber();
                    $subscriber->user_id = Auth::user()->id;
                    $subscriber->is_subscribed = 1;
                    $subscriber->subscription_start = $subscriptionRequest->subscription_start;
                    // $subscriber->subscription_end = $subscriptionRequest->subscription_end;
                    $subscriber->save();
                }
            }
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Subscription request status updated successfully!');
        } else {
            // Redirect back with an error message if the subscription request is not found
            return redirect()->back()->with('error', 'Subscription request not found!');
        }
    }
}
