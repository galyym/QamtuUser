<?php

namespace App\Services\Auth;

use App\Events\PhoneVerificationCode;
use Illuminate\Support\Facades\Redis;

class PhoneService
{
    public function login($request){

        $verification_code = rand(10000, 99999);
        Redis::setex("verification_code:".$request->input('email_code'), 500, $verification_code);
        event(new PhoneVerificationCode($verification_code, $request->phone));
        return response()->json(['message' => 'Verification code sent to phone number']);
    }

    public function verifyCode(){
        return "success";
    }
}
