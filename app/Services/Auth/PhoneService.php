<?php

namespace App\Services\Auth;

use App\Events\PhoneVerificationCode;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Responders\Responder;

class PhoneService
{
    protected $authService;
    protected $response;

    public function __construct(AuthService $authService, Responder $response)
    {
        $this->authService = $authService;
        $this->response = $response;
    }

    public function login($request){

        // Generate verification code
        $verification_code = rand(1000, 9999);

        // Check if phone number has been recently sent a code
//        $last_sent = Redis::get("verification_code_sent:".$request->phone);
//debug        if ($last_sent) {
//            $time_since_last_sent = time() - $last_sent;
//            if ($time_since_last_sent < 180) { // 180 seconds = 3 minutes
////                Redis::setex("verification_code:".$request->phone, 500, $verification_code);
////                event(new PhoneVerificationCode($verification_code, $request->phone));
//
//                return $this->response->success(
//                    'Verification code already sent. Please wait before requesting again.',
//                    ['resend_timer' => 180, 'have_time' => $time_since_last_sent]
//                );
//
//            }elseif ($time_since_last_sent < 1800) { // 1800 seconds = 30 minutes
////                Redis::setex("verification_code:".$request->phone, 500, $verification_code);
////                event(new PhoneVerificationCode($verification_code, $request->phone));
//
//                return $this->response->success(
//                    'Verification code already sent. Please wait 30 minutes before requesting again.',
//                    ['resend_timer' => 1800, 'have_time' => $time_since_last_sent]
//                );
//
//            }elseif ($time_since_last_sent < 10800) { // 10800 seconds = 3 hours
////                Redis::setex("verification_code:".$request->phone, 500, $verification_code);
////                event(new PhoneVerificationCode($verification_code, $request->phone));
//
//                return $this->response->success(
//                    'Verification code already sent. Please wait 3 hours before requesting again.',
//                    ['resend_timer' => 1800, 'have_time' => $time_since_last_sent]
//                );
//            }
//        }

        Redis::setex("verification_code:".$request->phone, 5000, $verification_code);
//debug        Redis::setex("verification_code:".$request->phone, 500, $verification_code);
        Redis::setex("verification_code_sent:".$request->phone, 10800, time());

        event(new PhoneVerificationCode($verification_code, $request->phone));

        return $this->response->success(
            'Verification code sent to phone number',
            ['resend_timer' => 180]
        );
    }

    public function verifyCode(Request $request){
        \Log::info("request", $request->all());
        $verification_code = Redis::get("verification_code:".$request->phone);
        \Log::info($verification_code);

        if ($verification_code != $request->verification_code) {
            return $this->response->error('Invalid verification code', [], 400);
        }

        $user = User::where('phone_number', $request->phone)->first();
        \Log::info($user);
        Redis::del("verification_code:".$request->phone);

        return $this->authService->token($user);
    }
}
