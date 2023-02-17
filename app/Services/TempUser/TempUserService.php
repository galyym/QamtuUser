<?php

namespace App\Services\TempUser;

use App\Http\Responders\Responder;
use App\Models\Reference\RbPosition;
use App\Models\Reference\RbPrivilege;

class TempUserService
{
    protected $response;

    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getInfoAppliction($user){
        $user_info = [
            "full_name" => $user['full_name'],
            "iin" => $user['iin'],
            "birthdate" => $user['birthdate'],
            "privilege" => RbPrivilege::get()->toArray(),
            "position" => RbPosition::all()->toArray()
        ];
        return $this->response->success("success", $user_info);
    }

    public function sendAppliction($request){
        $file = $request['resume']->store('/home/tobirama/Desktop');
        $file = $request['pension_application']->store('public');
        $file = array_key_exists('certificate_of_disability', $request) ? $request['certificate_of_disability']->store('public') : null;
        $file = array_key_exists('death_certificate', $request) ? $request['death_certificate']->store('public') : null;
        $file = array_key_exists('probation_certificate', $request) ? $request['probation_certificate']->store('public') : null;
        $file = array_key_exists('verdict_court', $request) ? $request['verdict_court']->store('public') : null;
        dd($file);
        return $this->response->success("success", $request);
    }

}
