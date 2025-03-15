<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    use HasFactory;

    // Define the table name if it's different from Laravel's naming convention (optional)
    // protected $table = 'founders';

    // Allow mass assignment for the listed fields
    protected $fillable = [
        'company_id',  // Add company_id here
        'name',
        'position',
        'education',
        'experience',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
