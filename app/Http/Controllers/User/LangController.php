<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responders\Responder;
use Illuminate\Support\Facades\Auth;

class LangController extends Controller
{
    protected $response;

    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getLang(){
        return $this->response->success("success", ["lang" => Auth::user()->lang]);
    }

    public function setLang(Request $request){
        $request->validate([
            "lang" => "required|string|max:10"
        ]);

        $user = Auth::user();
        $update = $user->where("id", $user->id)->update(['lang' => $request->lang]);

        if ($update){
            return $this->response->success("success");
        }else{
            return $this->response->error("error");
        }
    }
}
