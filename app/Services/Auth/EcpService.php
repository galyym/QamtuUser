<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Http\Responders\Responder;
use App\Helper\Pki;

class EcpService
{

    protected $response;
    protected $service;
    protected $pki;

    public function __construct(Responder $response, AuthService $service, Pki $pki){
        $this->response = $response;
        $this->service = $service;
        $this->pki = $pki;
    }

    public function authEcp($request){

        $base64 = $request->base64;
        $password = $request->password;

        $user_data = $this->pki->getCertificateInfo($base64, $password, true);

        if ($user_data) {

            $user = User::where("iin", $user_data["iin"])->first();

            if ($user) {
                return $this->service->token($user);
            }
            return $this->response->error("Қолданушы табылмады");
        }
        return response($user_data);
    }
}
