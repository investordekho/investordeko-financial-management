<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankerContactDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'banker_id',
        'email',
        'phone_number',
        'concerned_person_designation',
    ];

    // Relationship
    public function banker()
    {
        return $this->belongsTo(Banker::class);
    }
}
