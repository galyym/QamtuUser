<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\EmailService;

class EmailController extends Controller
{
    protected $service;

    public function __construct(EmailService $service){
        $this->service = $service;
    }

    public function login(LoginRequest $request){
        return $this->service->login($request);
    }

    public function verifyCode(Request $request){

        $request->validate([
            'verification_code' => 'required|numeric|digits:5',
            'email' => 'required|string|email'
        ]);

        return $this->service->verifyCode($request);
    }
}
