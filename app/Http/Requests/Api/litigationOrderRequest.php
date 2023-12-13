<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class litigationOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'subservice_id' => 'required|exists:subservices,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'owner_case' => 'required|string',
            'defendants_name' => 'required|string',
            'id_number_accused' => 'required|string',
        ];
    }
}
