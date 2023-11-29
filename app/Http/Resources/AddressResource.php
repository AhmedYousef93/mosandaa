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
            'id' => $this->id,
            'city_id' => $this->city->title ?? "",
            'area_id' => $this->area->title ?? "",
            'state_id' => $this->state->title ?? "",
            'street' => $this->street ?? "",
            'building_number' => $this->building_number ?? "",
            'primary' => $this->primary,
        ];
    }
}
