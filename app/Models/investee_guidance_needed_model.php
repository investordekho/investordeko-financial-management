<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class investee_guidance_needed_model extends Model
{
    
    protected $table = 'investee_guidance_needed';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'company_id',
        'guidance_needed',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
