<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'drop_point_id' => ['nullable', 'exists:drop_points,id'],
            'donor_name' => ['sometimes', 'required', 'string', 'max:255'],
            'donor_phone' => ['sometimes', 'required', 'string', 'max:20'],
            'clothing_type' => ['sometimes', 'required', 'string', 'max:100'],
            'quantity' => ['sometimes', 'required', 'integer', 'min:1', 'max:500'],
            'condition' => ['sometimes', 'required', 'in:sangat_baik,layak_pakai'],
            'delivery_method' => ['sometimes', 'required', 'in:antar_posko,ekspedisi'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }
}
