<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderMinimumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        self::wrap('orders');
        return [
            'id' => (int) $this->id,
            'title' => (string) $this->service?->title,
            'sub_service' => (string) $this->subservice?->title,
            'status' => (string) $this->status->label(),
            'time' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
