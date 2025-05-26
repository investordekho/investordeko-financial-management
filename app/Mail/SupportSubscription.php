<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;   
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ServiceContact;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionRequest;
use App\Models\payment_detail;
use App\Models\Subscriber;
use App\Models\SubscriptionPlan;

class SupportSubscription extends Mailable 
{
    use Queueable, SerializesModels;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function build()
{
    \Log::info('Building support email with data:', $this->data);

    return $this->subject('If You Have Any Query, Contact Us for Our Services')
                ->view('auth.mailcreation.supportforsubscription')
               ->with([
                    'name' => $this->data['name'] ?? 'No Name',
                    'email' => $this->data['email'] ?? 'No Email',
                    'phone' => (($this->data['countryCode'] ?? '') . ' ' . ($this->data['phone'] ?? '')) ?: 'No Phone',
                    'issueType' => $this->data['issueType'] ?? 'No IssueType',
                    'usermessage' => $this->data['message'] ?? 'No Message',
                ]);

}

    // public function build()
    // {
    //     return $this->subject('If You Have Any Query, Contact Us for Our Services')
    //                 ->view('auth.mailcreation.supportforsubscription')
    //                 ->with([
    //                     'name' => $this->data['name'],
    //                     'email' => $this->data['email'],
    //                     'phone' => $this->data['phone'],
    //                     'issueType' => $this->data['issueType'],
    //                     'message' => $this->data['message'],                        
    //                 ]);
    // }
}