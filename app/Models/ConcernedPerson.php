<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcernedPerson extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'concerned_persons'; // Explicitly define the table name

    protected $fillable = [
        'company_id',
        'name',
        'designation',
        'email',
        'phone',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
