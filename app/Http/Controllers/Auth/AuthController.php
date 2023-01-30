<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\Auth\AuthService;

class AuthController extends Controller
{
    protected $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function refreshToken(Request $request){

        return $this->service->refreshToken($request->refreshToken);
    }
}
