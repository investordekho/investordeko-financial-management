<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_subscribed',
        'subscription_start',
        'subscription_end',
    ];

    // Relationship to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

