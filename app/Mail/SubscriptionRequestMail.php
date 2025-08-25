<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
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

class SubscriptionRequestMail extends Mailable 
{
    use Queueable, SerializesModels;

    public $subscriptionRequest;

    public function __construct($subscriptionRequest)
    {
        $this->subscriptionRequest = $subscriptionRequest;
    }

    public function build()
    {
        return $this->subject('New Subscription Request')
                    ->view('auth.mailcreation.subscriptionrequestmail')
                    ->with([
                        'name' => $this->subscriptionRequest['name'],
                        'phone' => $this->subscriptionRequest['phone'],
                        'payment_method' => $this->subscriptionRequest['payment_method'],
                        'transaction_id' => $this->subscriptionRequest['transaction_id'],
                        'reference_id' => $this->subscriptionRequest['reference_id'],
                        'plan_amount' => $this->subscriptionRequest['plan_amount'],
                        'no_of_data' => $this->subscriptionRequest['no_of_data'],
                        // 'screenshot' => Storage::url($this->subscriptionRequest->screenshot),
                    ]);
    }
}