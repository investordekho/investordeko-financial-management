<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\SubscriptionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentDetail;
use App\Models\Users;
use Illuminate\Support\Str;
use App\Models\ServiceContact;
use Illuminate\Support\Facades\Mail;
use App\Models\payment_detail;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;  
class SubscriptionRequestApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

   
    public $subscriptionRequest;

     public function __construct($subscriptionRequest)
    {
        $this->subscriptionRequest = $subscriptionRequest;
    }

    public function build()
    {
        Log::info('Building SubscriptionRequestApprovedMail for user: ' . $this->subscriptionRequest['name']);
        // Log the details of the subscription
        Log::info('Plan Name: ' . $this->subscriptionRequest['plan_name']);
        Log::info('Plan Amount: ' .  $this->subscriptionRequest['amount']);
        Log::info('Plan Validity: ' . $this->subscriptionRequest['validity']);
        return $this->view('auth.mailcreation.subscription_approved')
                    ->subject('Your Subscription is Approved')
                    ->with([
                        'userName' => $this->subscriptionRequest['name'],
                        'planName' => $this->subscriptionRequest['plan_name'],
                        'planAmount' => $this->subscriptionRequest['amount'],
                        'planValidity' => $this->subscriptionRequest['validity'],
                    ]);
    }
}
