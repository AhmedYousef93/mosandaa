<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\API\ApiFormRequest;

class VerifyRequest extends ApiFormRequest
{
   
    public function rules()
    {
        return [
            'code'  => ['required', 'numeric'],
        ];
    }
}
