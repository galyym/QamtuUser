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
            "id" => $this->id,
            "title" => $this->title,
            "anons" => $this->anons,
            "body" => $this->body,
            "image" => "https://static.tudointeressante.com.br/uploads/2015/06/animais-fotogenicos-2.jpg",
            "created_at" => Carbon::parse($this->created_at)->toDateString()
        ];
    }
}
