<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'country',
        'state',
        'city',
        'zip_code'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
