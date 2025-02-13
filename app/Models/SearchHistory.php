<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    // Define the table associated with the model, if it's different from the default "search_histories"
    protected $table = 'search_histories';

    // Define the fillable fields
    protected $fillable = [
        'user_id',      // Assuming you'll log user ID
        'search_query', // The search term
        'user_type',    // The user type (e.g., investee, investor, banker)
        'created_at',   // The timestamp of when the search was performed
    ];

    // You can define relationships here if needed, for example, linking the search to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
