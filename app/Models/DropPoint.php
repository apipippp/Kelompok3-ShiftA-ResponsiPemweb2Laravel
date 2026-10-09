<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class DropPoint extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'pic_name',
        'pic_phone',
        'operating_hours',
        'photo',
        'maps_url',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}