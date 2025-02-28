<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    // Specify the fields that can be mass-assigned
    protected $fillable = [
        'user_id', 'investor_name', 'address', 'investor_profile', 'sectors_preferred'
    ];

    // Define relationships

    // One-to-One relationship for contact details
    public function contactDetails()
    {
        return $this->hasOne(ContactDetails::class);
    }

    // One-to-Many relationship for public links
    public function publicLinks()
    {
        return $this->hasMany(PublicLink::class);
    }

    // One-to-One relationship for investment details
    public function investmentDetails()
    {
        return $this->hasOne(InvestmentDetail::class);
    }

    // One-to-Many relationship for previous investments
    public function previousInvestments()
    {
        return $this->hasMany(PreviousInvestment::class);
    }

    // One-to-One relationship for referrals
    public function referrals()
    {
        return $this->hasOne(Referral::class);
    }

    // One-to-One relationship for guidance needs
    public function guidanceNeeds()
    {
        return $this->hasOne(GuidanceNeed::class);
    }

    // Ensure sectors_preferred is cast as an array in the database
   

    // Define public links relationship again for backward compatibility, if needed
    public function public_links()
    {
        return $this->hasMany(PublicLink::class);
    }

    public function investorAddresses()
    {
        return $this->hasMany(InvestorAddress::class);
    }
}
