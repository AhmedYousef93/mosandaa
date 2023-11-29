<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserProofileRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => ['nullable','string','max:55'],
            'email'  => ['nullable','email','max:155',Rule::unique('users')->ignore(auth()->user()->id)],
            'phone'    => ['nullable' , 'digits:9' ,Rule::unique('users')->ignore(auth()->user()->id)],
        ];
    }

}
