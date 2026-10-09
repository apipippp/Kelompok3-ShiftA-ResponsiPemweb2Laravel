<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tracking_code' => $this->tracking_code,
            'donor_name' => $this->donor_name,
            'donor_phone' => $this->donor_phone,
            'clothing_type' => $this->clothing_type,
            'quantity' => $this->quantity,
            'condition' => $this->condition,
            'condition_label' => $this->condition_label,
            'delivery_method' => $this->delivery_method,
            'delivery_method_label' => $this->delivery_method_label,
            'photo_url' => $this->photo ? asset('storage/' . $this->photo) : null,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'notes' => $this->notes,
            'user' => new UserResource($this->whenLoaded('user')),
            'drop_point' => new DropPointResource($this->whenLoaded('dropPoint')),
            'distribution' => new DistributionResource($this->whenLoaded('distribution')),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
