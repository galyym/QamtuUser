<?php

namespace App\Services\Auth;

use App\Models\TempUser;
use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
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

    /**
     * @throws GuzzleException
     */
    public function authEcp($request){

        $base64 = $request['base64'];
        $password = $request['password'];

        $user_data = $this->pki->getCertificateInfo($base64, $password, true);

        if ($user_data) {
            $user = User::where("iin", $user_data["iin"])->first();

            if ($user) {
                $token = $this->service->token($user);
                $token += ['status' => 1];
                return $token;
            } else {

                $user = TempUser::where('iin', $user_data['iin'])->first();

                if (!$user) {
                    $user = TempUser::updateOrCreate([
                        'full_name' => $user_data['full_name'],
                        'iin' => $user_data['iin'],
                        'email' => $user_data['email'],
                        'birthdate' => $user_data['birthdate']
                    ]);
                }
                $token = $this->service->token($user, true);
                if ($user->request_status_id == 1 || $user->request_status_id == '1') {
                    $token += ['status' => 2];
                }else{
                    $token += ['status' => 3];
                }

                return $token;
            }
        }
        return response($user_data);
    }
}
