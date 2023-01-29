<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\PhoneService;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    protected $service;

    public function __construct(PhoneService $service){
        $this->service = $service;
    }

    public function login(LoginRequest $request){
        return $this->service->login($request);
    }

    public function verifyCode(Request $code){
        return $this->service->verifyCode($code);
    }
}
