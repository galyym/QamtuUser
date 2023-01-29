<?php

namespace App\Services\Auth;

use App\Events\EmailVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;

class EmailService
{
    public function login($request){

        $verification_code = rand(10000, 99999);
        Redis::setex("verification_code:".$request->email, 500, $verification_code);
        event(new EmailVerificationCode($verification_code, $request->email));
        return response()->json(['message' => 'Verification code sent to email']);
    }

    public function verifyCode($request){

        $verification_code = Redis::get("verification_code:".$request->email);

        if ($verification_code != $request->verification_code) {
            return response()->json(['error' => 'Invalid verification code'], 400);
        }

        $user = User::where('email', $request->email)->first();
//        $token = $user->createToken('Laravel App')->accessToken;

//        Redis::del("verification_code:".$request->email);

        return $this->token($user);
    }

    public function token($user){

        $http = new Client();
        $client = \DB::table('oauth_clients')->select('id', 'secret')->where('id', '=', 2)->first();

        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => $client->id,
                'client_secret' => $client->secret,
                'username'      => $user->email,
                'password'      => $user->password,
                'scope' => ''
            ]
        ]);

        return json_decode((string) $response->getBody(), true);

    }
}
