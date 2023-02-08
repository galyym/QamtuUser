<?php

namespace App\Http\Resources\Announce;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Announce;

class AnnounceWithIdRecource extends JsonResource
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
            "id" => $this->id ?? null,
            "title" => $this->title ?? null,
            "anons" => $this->anons ?? null,
            "body" => $this->body ?? null,
            "image" => "https://portal.qamtu.kz/api/public".$this->image ?? null,
            "created_at" => Carbon::parse($this->created_at)->toDateString() ?? null
        ];
    }
}
