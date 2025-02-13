<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankerPublicLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'banker_id',
        'url',
        'link_description',
    ];

    // Relationship
    public function banker()
    {
        return $this->belongsTo(Banker::class);
    }
}
