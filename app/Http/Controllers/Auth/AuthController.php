<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function refreshToken(Request $request){

        $http = new Client();

        $response = $http->post(config('auth.app_url').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->bearerToken(),
                'client_id' => config('auth.client_id'),
                'client_secret' => config('auth.client_secret'),
                'scope' => '',
            ],
        ]);

        return $response;
    }
}
