<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
            'phone' => (string) $this->phone,
            'code' => (string) $this->code,
            'is_verified' => (int) $this->verified,
            'nationality' => (string) $this->userDetails->nationality,
            'sponsor_name' => (string) $this->userDetails->sponsor_name,
            'national_address' => (string) $this->userDetails->national_address,
            'date_of_entering' => (string) $this->userDetails->date_of_entering,
            'passport_number' => (string) $this->userDetails->passport_number,
            'salary' => (string) $this->userDetails->salary,
            'sponsor_residence' => (string) $this->userDetails->sponsor_residence,
            'labor_city' => (string) $this->userDetails->labor_city,
            'id_number' => (string) $this->userDetails->id_number,
            'date_of_birth' => (string) $this->userDetails->date_of_birth,
            'access_token' => (string) $this->token,
        ];
    }
}
