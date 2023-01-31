<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Models\User;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    protected AuthService $service;
    protected Responder $response;
    public function __construct(AuthService $service, Responder $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    /**
     * @throws GuzzleException
     */
    public function refreshToken(Request $request){

        return $this->service->refreshToken($request->refreshToken);
    }

    /**
     * temp method auth with notify
    */
    public function login(Request $request){
        $user = User::where("iin", $request->iin)->where('phone_number', $request->phone)->first();
        if ($user){
            if (isset($request->firebase_token)){
                User::where('id', $user->id)->update(["firebase_token" => $request->firebase_token]);

                $verification_code = rand(1000, 9999);
                Redis::setex("verification_code:".$request->iin, 5000, $verification_code);

                Http::withHeaders([
                    "Authorization" => config("auth.firebase_token"),
                    "Content-Type" => "application/json",
                ])->post('https://fcm.googleapis.com/fcm/send', [
                    "to" => $request->firebase_token,
                    "notification" => [
                        'title' => 'Код для доступа к системе',
                        'body' => $verification_code,
                        'sound' => true
                    ],
                    "data" => [
                        'type' => 'verification_code',
                        'child_id' => $verification_code
                    ]
                ]);
            }
            return $this->response->success("success", ["id" => $user->id]);
        }else{
            return $this->response->error("not found");
        }
    }

    public function verifyCode(Request $request){
        $validation = $request->validate([
            "iin" => 'required'
        ]);

        $verification_code = Redis::get("verification_code:".$request->iin);

        if ($verification_code != $request->verification_code) {
            return $this->response->error('Invalid verification code', [], 400);
        }

        $user = User::where('iin', $request->iin)->first();
        Redis::del("verification_code:".$request->iin);

        return $this->service->token($user);
    }
}
