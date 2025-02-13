<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'investors_id',
        'concerned_person_name',
        'concerned_person_designation',
        'concerned_person_phone',
        'email',
    ];
}



