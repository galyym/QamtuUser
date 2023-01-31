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
            "id" => $this->id,
            "iin" => (string)$this->iin,
            "full_name" => $this->full_name,
            "birthdate" => $this->birthdate,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "address" => $this->address,
            "status" => new StatusResource($this->status),
            "privilege" => new PrivilegeResource($this->privilege)
        ];
    }
}
