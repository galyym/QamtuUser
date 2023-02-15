<?php

namespace App\Services\Profile;

use App\Http\Resources\User\ApplicantResource;
use App\Http\Responders\Responder;
use App\Models\Reference\RbPosition;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        $birthdate = Carbon::parse($user->birthdate);

        $data = [
            "full_name" => $profile["full_name"],
            "email" => $profile["email"],
            "phone_number" => $profile["phone_number"],
            "birthdate" => $profile["birthdate"],
            "age" => $birthdate->diffInYears(Carbon::now()),
            "position" => $positions["name_kk"],
            "family_status" => "белгісіз",
            "privilege" => $profile["privilege"]["name_kk"],
            "image_url" => config("auth.app_url")."/image/profile/default.png"
        ];

//        return $this->response->success('Profile', ApplicantResource::collection($profile));
        return $this->response->success('Profile', $data);
    }
}
