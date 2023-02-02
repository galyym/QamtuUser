<?php

namespace App\Http\Resources\Ranging;

use Carbon\Carbon;
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
            "address" => $this->address ?? null,
            "interview_date" => $this->interview_date ?? null,
            "interview_time" => Carbon::parse($this->interview_time)->toTimeString() ?? null,
            "interview_comment" => $this->interview_comment ?? null,
            "order_date" => $this->order_date ?? null,
        ];
    }
}
