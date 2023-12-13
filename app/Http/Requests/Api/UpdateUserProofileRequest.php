<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProofileRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:55'],
            'email' => ['nullable', 'email', 'max:155', Rule::unique('users')->ignore(auth()->user()->id)],
            'phone' => ['nullable', 'digits:9', Rule::unique('users')->ignore(auth()->user()->id)],
            'date_of_birth' => ['nullable', 'date_format:Y-m-d'],
            'nationality' => ['nullable', 'string'],
            'sponsor_name' => ['nullable', 'string'],
            'national_address' => ['nullable', 'string'],
            'passport_number' => ['nullable', 'string'],
            'salary' => ['nullable', 'integer'],
            'sponsor_residence' => ['nullable', 'string'],
            'labor_city' => ['nullable', 'string'],
            'date_of_entering' => ['nullable', 'date_format:Y-m-d'],
            'id_number' => ['nullable', 'digits:10', Rule::unique('user_details')->ignore(auth()->user()->id)],
            'attachments' => ['array'],
            'attachments.*' => ['exists:attachments,id'],

        ];
    }

}





















