<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment_detail;

class SubscriptionRequest extends Model
{
    
    protected $table = 'subscription_requests';
    
        protected $fillable = [
            'user_id',
            'payment_detail_id',
            'plan',
            'subscription_start',
            'subscription_end',
            'no_of_data',
            'plan_amount',
            'status',
            'created_at',
            'updated_at',
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        
        public function paymentDetail()
        {
            return $this->belongsTo(Payment_detail::class, 'payment_detail_id', 'id');
        }
        
}
