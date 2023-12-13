<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => ['required','string','max:55'],
            'phone'  => ['required' , 'digits:9' ,'unique:users'],
            'email'  => ['email','max:155','unique:users'],
            'id_number' => ['required','digits:10','unique:user_details'],
            'password'  => ['required','min:8','confirmed'],
            'fcm_token' => ['required', 'string'],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
        ];
    }

}
