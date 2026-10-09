<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DropPointResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'pic_name' => $this->pic_name,
            'pic_phone' => $this->pic_phone,
            'operating_hours' => $this->operating_hours,
            'photo_url' => $this->photo ? asset('storage/' . $this->photo) : null,
            'maps_url' => $this->maps_url,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
