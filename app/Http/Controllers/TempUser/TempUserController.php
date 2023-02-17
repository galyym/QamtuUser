<?php

namespace App\Http\Controllers\TempUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\TempUserRequest;
use Illuminate\Http\Request;
use App\Services\TempUser\TempUserService;

class TempUserController extends Controller
{
    protected $service;

    public function __construct(TempUserService $service){
        $this->service = $service;
    }

    public function getInfoAppliction(){
        $auth = auth()->user();
        return $this->service->getInfoAppliction($auth);
    }

    public function sendAppliction(TempUserRequest $request){
        $user = auth()->user();
        return $this->service->sendAppliction($request->validated(), $user);
    }
}
