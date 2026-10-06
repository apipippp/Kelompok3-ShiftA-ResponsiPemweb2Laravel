<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}