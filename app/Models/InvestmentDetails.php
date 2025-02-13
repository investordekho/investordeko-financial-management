<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentDetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'investor_id',
        'invest_in',
        'investor_type',
        'investment_size',
        'investment_tenure'
    ];

}
