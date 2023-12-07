<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
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
            'time' => (string) convert_time_twelve($this->time),
            'status' => $this->orderTimeDates->where('date', $request->date)->isNotEmpty() ? 1 : 0,
        ];
    }
}
