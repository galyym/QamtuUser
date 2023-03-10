<?php

namespace App\Services\Auth;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected Responder $response;
    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    /**
     * @throws GuzzleException
     */
    public function token($user, $temp_user = false){

        $client_id = 2;
        if ($temp_user){
            $client_id = 4;
        }
        $client = DB::table('oauth_clients')->select('id', 'secret')->where('id', '=', $client_id)->first();
        $http = new Client();
        $response = $http->post(config("auth.app_url").'/oauth/token', [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => intval($client->id),
                'client_secret' => (string)$client->secret,
                'username'      => (string)$user->iin,
                'password'      =>  "123"
            ]
        ]);

        if ($response->getStatusCode() === 500){
            return $this->response->error('401 Unauthorized', [], 401);
        }
        return  json_decode((string) $response->getBody(), true);
    }


    /**
     * Тупая логика, надо, переделать так, чтобы ошибок не было или чтобы ошибки обрабатывались правильно. Бір сөзбен дұрыстау керек
     * @param $refreshToken
     * @throws GuzzleException
     */
    public function refreshToken($refreshToken)
    {
        $http = new Client();
        $client = DB::table('oauth_clients')->select('id', 'secret')->where('id', '=', 2)->first();

        try {
            $response = $http->request('POST',config("auth.app_url").'/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'client_id'     => intval($client->id),
                    'client_secret' => (string)$client->secret
                ]
            ]);

            return json_decode((string) $response->getBody(), true);
        }catch (ClientException $e){
            return $this->response->error('401 Unauthorized', [], 401);
        }
    }
}
