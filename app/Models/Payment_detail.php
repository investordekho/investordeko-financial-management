<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_detail extends Model
{
    protected $table = 'payment_details';

    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_method',
        'amount',
        'currency',
        'transaction_id',
        'reference_id',
        'phone',
        'screen_shot',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id', 'id');
    }
}
