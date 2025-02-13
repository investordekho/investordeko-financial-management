<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousInvestment extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'previous_investment_year',
        'previous_investment_company',
        'sector'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}

