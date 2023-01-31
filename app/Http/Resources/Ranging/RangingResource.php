<?php

namespace App\Http\Resources\Ranging;

use Illuminate\Http\Resources\Json\JsonResource;

class RangingResource extends JsonResource
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
            "address" => $this->address,
            "interview_date" => $this->interview_date,
            "interview_time" => $this->interview_time,
            "interview_comment" => $this->interview_comment,
            "order_date" => $this->order_date,
        ];
    }
}
