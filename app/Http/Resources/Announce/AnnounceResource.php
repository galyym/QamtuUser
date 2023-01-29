<?php

namespace App\Http\Resources\Announce;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnounceResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "anons" => $this->anons,
            "created_at" => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
