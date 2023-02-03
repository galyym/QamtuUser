<?php

namespace App\Services\Auth;

use App\Events\EmailVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use App\Services\Auth\AuthService;
use App\Http\Responders\Responder;

class EmailService
{

    protected $authService;
    protected $response;
    public function __construct(AuthService $authService, Responder $response)
    {
        $this->authService = $authService;
        $this->response = $response;
    }

    public function login($request){

        $verification_code = rand(1000, 9999);
        if($request->email == "demo@demo.com"){
            $verification_code = "0000";
        }
        Redis::setex("verification_code:".$request->email, 500, $verification_code);
        event(new EmailVerificationCode($verification_code, $request->email));

        return $this->response->success('Verification code sent to email');
    }

    public function verifyCode($request){

        $verification_code = Redis::get("verification_code:".$request->email);

        if ($verification_code != $request->verification_code) {

            return $this->response->error('Invalid verification code', [], 400);
        }

        $user = User::where('email', $request->email)->first();
        Redis::del("verification_code:".$request->email);

        return $this->authService->token($user);
    }
}
