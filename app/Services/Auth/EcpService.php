<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Http\Responders\Responder;
use App\Services\Auth\AuthService;

class EcpService
{

    protected $response;
    protected $service;

    public function __construct(Responder $response, AuthService $service){
        $this->response = $response;
        $this->service = $service;
    }

    public function authEcp($request){

        $base64 = $request->base64;
        $password = $request->password;

        $response = [
            "version" => "1.0",
            "method" => "PKCS12.info",
            "params" => [
                "p12" => $base64,
                "password" => $password
            ]
        ];

        $user_data = $this->checkEcp($response);

        if ($user_data["status"] === 0) {

            $iin = $user_data["result"]["subject"]["iin"];
            $user = User::where("iin", $iin)->first();
            if ($user) {
                return $this->service->token($user);
            }
            return $this->response->error("С");
        } elseif ($user_data["status"] === 3){
            return $this->response->error("Сіздің құпия сөзіңіз немесе электронды қолтаңбаңыз дұрыс емес");
        }

        return $this->response->error("Белгісіз қателіктер");
    }

    protected function checkEcp($data){
        $request = Http::post(config("auth.pki_url"), $data);
        return $request->json();
    }
}
