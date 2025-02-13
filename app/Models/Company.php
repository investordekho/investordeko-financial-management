<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Define the table if it's not the plural form of the model name
    protected $table = 'companies';

    // Define the fillable fields
    protected $fillable = [
        'user_id', 
        'company_name', 
        'address', 
        'nature_of_business', 
        'incorporated_in', 
        'website', 
        'linkedin'
    ];

    // Relationship with User model (one-to-one, assuming a company belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with ConcernedPerson model (one-to-one)
    public function concernedPerson()
    {
        return $this->hasOne(ConcernedPerson::class);
    }

    // Define relationship with Founder model (one-to-many)
    public function founders()
    {
        return $this->hasMany(Founder::class);
    }

    // Define relationship with FundRequirement model (one-to-many)
    public function fundRequirements()
    {
        return $this->hasMany(FundRequirement::class);
    }

    // Define relationship with PreviousRound model (one-to-many)
    public function previousRounds()
    {
        return $this->hasMany(PreviousRound::class);
    }

    // Define relationship with OtherLink model (one-to-many)
    public function otherLinks()
    {
        return $this->hasMany(OtherLink::class);
    }

    // Define relationship with Attachment model (one-to-many)
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // Define relationship with ReferralSource model (one-to-one)
    public function referralSource()
    {
        return $this->hasOne(ReferralSource::class);
    }
}
