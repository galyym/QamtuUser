<?php

namespace App\Services\Auth;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class AuthService
{
    public function token($user){

        $http = new Client();
        $client = \DB::table('oauth_clients')->select('id', 'secret')->where('id', '=', 2)->first();

        $response = $http->post(config("auth.app_url").'/oauth/token', [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => intval($client->id),
                'client_secret' => (string)$client->secret,
                'username'      => (string)$user->email,
                'password'      => '123'
            ]
        ]);

        if ($response->getStatusCode() === 500){
            return response("401 Unauthorized", 401);
        }
        return json_decode((string) $response->getBody(), true);
    }

    public function refreshToken($refreshToken){
        $http = new Client();
        $client = \DB::table('oauth_clients')->select('id', 'secret')->where('id', '=', 2)->first();

        $response = $http->post(config("auth.app_url").'/oauth/token', [
            'form_params' => [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id'     => intval($client->id),
                'client_secret' => (string)$client->secret
            ]
        ]);
        if ($response->getStatusCode() === 500){
            return response("401 Unauthorized", 401);
        }
        return json_decode((string) $response->getBody(), true);
    }
}
