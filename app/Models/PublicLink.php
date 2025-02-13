<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'url',
        'link_description'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
