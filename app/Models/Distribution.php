<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $fillable = [
        'recipient_name',
        'distribution_date',
        'items_count',
        'proof_photo',
        'description',
    ];

    protected $casts = [
        'distribution_date' => 'date',
    ];
}