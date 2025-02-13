<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidanceNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'guidance_needed',
        'other_guidance'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
