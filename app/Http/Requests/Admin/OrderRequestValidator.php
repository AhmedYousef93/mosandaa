<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequestValidator extends FormRequest
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
            'date' => 'required|date',
            'time_id' => 'required|exists:times,id',
            'researcher_name' => 'required|string',
            'researcher_title' => 'required|string',
            'type' => 'required|integer',
            'case_language' => 'required|integer',
        ];
    }
}
