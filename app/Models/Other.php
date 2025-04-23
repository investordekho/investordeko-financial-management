<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'country',
        'referral_source',
        'agreed_to_terms',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

