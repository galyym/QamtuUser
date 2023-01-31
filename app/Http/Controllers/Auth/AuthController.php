<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Models\User;
use App\Http\Responders\Responder;

class AuthController extends Controller
{
    protected AuthService $service;
    protected Responder $response;
    public function __construct(AuthService $service, Responder $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    /**
     * @throws GuzzleException
     */
    public function refreshToken(Request $request){

        return $this->service->refreshToken($request->refreshToken);
    }

    /**
     * temp method auth with notify
    */
    public function login(Request $request){
        $user = User::where("iin", $request->iin)->where('phone_number', $request->phone)->first();
        if ($user){

            if (isset($request->firebase_token)){
                dd(User::find($user->id)->update(['firebase_token' => $request->firebase_token]));
                dd($user->update());
            }

            return $this->response->success("success", ["id" => $user->id]);
        }else{
            return $this->response->error("not found");
        }
    }
}
