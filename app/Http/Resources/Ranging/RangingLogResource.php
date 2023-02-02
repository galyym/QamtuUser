<?php

namespace App\Http\Resources\Ranging;

use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\Reference\StatusResource;
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
            "admin_full_name" => $this->admin_full_name ?? null,
            'ranging' => new RangingResource($this->ranging) ?? null,
            'company' => new CompanyResource($this->company) ?? null,
            'status' => new StatusResource($this->status) ?? null
        ];
    }
}
