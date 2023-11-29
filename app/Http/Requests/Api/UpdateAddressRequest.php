<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'city_id' => ['nullable', 'exists:cities,id', 'numeric'],
            'state_id' => ['nullable', 'exists:states,id', 'numeric'],
            'area_id' => ['nullable', 'exists:states,id', 'numeric'],
            'street' => ['nullable', 'string', 'max:255'],
            'building_number' => ['nullable', 'string', 'max:255'],
        ];
    }
}
