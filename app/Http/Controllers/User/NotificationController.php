<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $response;
    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getNotification(){
        if (Auth::user()->firebase_token) return $this->response->success("success");
        return $this->response->error("error");
    }

    public function setNotification(Request $request){
        $user = Auth::user();
        $update = $user->where("id", $user->id)->update([
            "firebase_token" => $request->firebase_token
        ]);

        if ($update) return $this->response->success("success");
        return $this->response->error("error");
    }

}
