<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'referral_source'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
