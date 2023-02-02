<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Reference\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Reference\PrivilegeResource;

class ApplicantResource extends JsonResource
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
            "iin" => (string)$this->iin ?? null,
            "full_name" => $this->full_name ?? null,
            "birthdate" => $this->birthdate ?? null,
            "email" => $this->email ?? null,
            "phone_number" => $this->phone_number ?? null,
            "address" => $this->address ?? null,
            "status" => new StatusResource($this->status) ?? null,
            "privilege" => new PrivilegeResource($this->privilege) ?? null
        ];
    }
}
