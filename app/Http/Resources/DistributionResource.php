<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'donation_id' => $this->donation_id,
            'recipient_name' => $this->recipient_name,
            'distribution_date' => $this->distribution_date?->format('Y-m-d'),
            'items_count' => $this->items_count,
            'proof_photo_url' => $this->proof_photo ? asset('storage/' . $this->proof_photo) : null,
            'description' => $this->description,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
