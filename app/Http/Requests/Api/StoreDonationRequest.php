<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'drop_point_id' => ['nullable', 'exists:drop_points,id'],
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_phone' => ['required', 'string', 'max:20'],
            'clothing_type' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:1', 'max:500'],
            'condition' => ['required', 'in:sangat_baik,layak_pakai'],
            'delivery_method' => ['required', 'in:antar_posko,ekspedisi'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }
}
