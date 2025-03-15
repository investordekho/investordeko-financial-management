<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundRequirement extends Model
{
    use HasFactory;
    // Allow mass assignment for the listed fields
    protected $fillable = [
        'company_id',  // Add company_id here
        'usage',
        'requirement',
        'unit',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
