<?php 

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Investee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\GuidanceNeededInvestee;
use Illuminate\Support\Facades\Mail;

class GuidanceNeededInvesteeMail extends Mailable 
{
    use Queueable, SerializesModels;

    public $subscriptionRequest;

    public function __construct($subscriptionRequest)
    {
        $this->subscriptionRequest = $subscriptionRequest;
    }

    public function build()
    {
        return $this->subject('New Guidance Needed Investee Reequest')
                    ->view('auth.mailcreation.guidanceneededinvesteemail')
                    ->with([
                        'user_id'=> $this->subscriptionRequest['user_id'],
                        'name'=> $this->subscriptionRequest['name'],
                        'phone'=> $this->subscriptionRequest['phone'],
                        'email'=> $this->subscriptionRequest['email'],
                        'concern_person_name'=> $this->subscriptionRequest['concern_person_name'],
                        'concern_person_phone'=> $this->subscriptionRequest['concern_person_phone'],
                        'concern_person_email'=> $this->subscriptionRequest['concern_person_email'],
                        'concern_person_designation'=> $this->subscriptionRequest['concern_person_designation'],
                        'company_name'=> $this->subscriptionRequest['company_name'],
                        'company_website'=> $this->subscriptionRequest['company_website'],
                        'guidance_needed'=> $this->subscriptionRequest['guidance_needed'],
                    ]);
    }
}