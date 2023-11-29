<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserShowResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'code' => $this->code,
            'is_verified' => (int)$this->verified,
            'nationality' => $this->userDetails->nationality == null ? null : $this->userDetails->nationality,
            'sponsor_name' => $this->userDetails->sponsor_name == null ? null : $this->userDetails->sponsor_name,
            'national_address' => $this->userDetails->national_address == null ? null : $this->userDetails->national_address,
            'date_of_entering' => $this->userDetails->date_of_entering == null ? null : $this->userDetails->date_of_entering,
            'passport_number' => $this->userDetails->passport_number == null ? null : $this->userDetails->passport_number,
            'salary' => $this->userDetails->salary == null ? null : $this->userDetails->salary,
            'sponsor_residence' => $this->userDetails->sponsor_residence == null ? null : $this->userDetails->sponsor_residence,
            'labor_city' => $this->userDetails->labor_city == null ? null : $this->userDetails->labor_city,
            'id_number' => $this->userDetails->id_number == null ? null : $this->userDetails->id_number,
            'date_of_birth' => $this->userDetails->date_of_birth == null ? null : $this->userDetails->date_of_birth,
        ];
    }
}
