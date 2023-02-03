<?php

namespace App\Services\Profile;

use App\Http\Resources\User\ApplicantResource;
use App\Http\Responders\Responder;
use App\Models\Reference\RbPosition;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    protected $response;
    public function __construct(Responder $response){
        $this->response = $response;
    }

    public function getProfile(){
        $user = Auth::user();
        $profile = $user->with(['status', 'privilege'])
            ->where('id', Auth::id())
            ->first()
            ->toArray();

        $positionIds = explode('@', $user->positions);
        $positions = RbPosition::whereIn('id', $positionIds)->first()->toArray();

        $data = [
            "full_name" => $profile["full_name"],
            "email" => $profile["email"],
            "phone_number" => $profile["phone_number"],
            "birthdate" => $profile["birthdate"],
            "age" => 45,
            "position" => $positions["name_kk"],
            "family_status" => "Example",
            "privilege" => $profile["privilege"]["name_kk"],
            "image_url" => 'https://webpulse.imgsmail.ru/imgpreview?mb=webpulse&key=pulse_cabinet-image-82558636-9ac1-495f-b4a3-6a6961221aff'
        ];

//        return $this->response->success('Profile', ApplicantResource::collection($profile));
        return $this->response->success('Profile', $data);
    }
}
