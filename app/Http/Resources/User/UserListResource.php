<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Reference\PrivilegeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListResource extends JsonResource
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
            'full_name' => $this->full_name,
            'iin' => $this->iin,
            'privilege' => new PrivilegeResource($this->privilege)
        ];
    }
}
