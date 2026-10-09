<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Distribution extends Model
{
    protected $fillable = [
        'donation_id',
        'recipient_name',
        'distribution_date',
        'items_count',
        'proof_photo',
        'description',
    ];

    protected $casts = [
        'distribution_date' => 'date',
    ];

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
}