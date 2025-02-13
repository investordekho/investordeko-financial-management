<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankerReferral extends Model
{
    use HasFactory;

    protected $fillable = [
        'banker_id',
        'referral_source',
    ];

    // Relationship
    public function banker()
    {
        return $this->belongsTo(Banker::class);
    }
}
