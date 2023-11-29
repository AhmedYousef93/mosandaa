<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id' => (int) $this->id,
            'city_id' => (string) $this->city->title ?? "",
            'area_id' => (string) $this->area->title ?? "",
            'state_id' => (string) $this->state->title ?? "",
            'street' => (string) $this->street ?? "",
            'building_number' => (string) $this->building_number ?? "",
            'primary' => (int) $this->primary,
        ];
    }
}
