<?php

namespace App\Http\Requests\API;

use App\Http\Requests\Api\ApiFormRequest;

class UpdatePasswordRequest extends ApiFormRequest
{
  
    public function rules()
    {
        return [
            'password' => ['required','string','min:8','confirmed'],
        ];
    }
}
