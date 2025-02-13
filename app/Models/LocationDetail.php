<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationDetail extends Model
{
    use HasFactory;

    // Add this if you don't want to use Laravel's default timestamps
    public $timestamps = false;

    // Define the table if it's not the default `location_details`
    protected $table = 'location_details';

    // Define the fillable fields for mass assignment
    protected $fillable = ['name'];
}

