<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'incorporated_in',
        'ib_team_size',
        'company_profile',
        'address',
        'location',
        'state',
        'country',
        'min_fund_raise_size',
        'max_fund_raise_size',
    ];

    // Relationships
    public function contactDetails()
    {
        return $this->hasOne(BankerContactDetail::class);
    }

    public function publicLinks()
    {
        return $this->hasMany(BankerPublicLink::class);
    }

    public function previousDeals()
    {
        return $this->hasMany(BankerPreviousDeal::class);
    }

    public function referrals()
    {
        return $this->hasOne(BankerReferral::class);
    }
}

