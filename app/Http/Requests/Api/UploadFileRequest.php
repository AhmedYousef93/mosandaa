<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id'    => ['integer','exists:attachments,id'],
            'title' => ['required','string','max:55'],
            'size'  => ['required'],
            'file' => ['nullable', 'mimes:pdf,jpeg,png,gif,mp3,wav,mpga,mpeg', 'max:2048'],

        ];
    }
}
