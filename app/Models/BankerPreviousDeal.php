<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankerPreviousDeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'banker_id',
        'previous_deal_year',
        'previous_deal_company',
        'previous_deal_sector',
        'previous_deal_type',
    ];

    // Relationship
    public function banker()
    {
        return $this->belongsTo(Banker::class);
    }
}
