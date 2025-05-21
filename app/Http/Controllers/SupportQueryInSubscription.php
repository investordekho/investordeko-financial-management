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
    use App\Models\SubscriptionPlan;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\SupportSubscription;

    class SupportQueryInSubscription extends Controller
    {
        public function submitsupportrequest(Request $request)
        {
            //  dd('Controller method is called');
              \Log::info('Entered submitsupportrequest controller method');
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:25',
                'issueType' => 'required|string|max:25',
                'message' => 'nullable|string',
            ]);

            // Log the incoming request
            \Log::info('Support Query submitted.', ['input' => $request->all()]);

            // Attempt to send email
            try {
                \Log::info('Attempting to send support mail.');
                Mail::to('investordekhopoojad@gmail.com')->send(new SupportSubscription($request->all()));
                \Log::info('Support mail sent successfully.');
                return redirect()->back()->with('success', 'Your request has been submitted successfully.');
            } catch (\Exception $e) {
                \Log::error('Error sending mail.', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()->back()->with('error', 'There was an error submitting your request. Please try again.');
            }
        }
    }