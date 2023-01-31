<?php

namespace App\Http\Resources\Ranging;

use Illuminate\Http\Resources\Json\JsonResource;

class RangingLogResource extends JsonResource
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
            "admin_id" => $this->admin_id,
            "admin_full_name" => $this->admin_full_name,
            "company_bin" => $this->company_bin,
            "raning" => $this->raning,
            "company" => $this->company,
            "status" => $this->status,
        ];

//        return parent::toArray($request);
    }
}
