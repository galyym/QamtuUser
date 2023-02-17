<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EcpRequest;
use Illuminate\Http\Request;
use App\Services\Auth\EcpService;

class EcpController extends Controller
{
    protected $service;

    public function __construct(EcpService $service){
        $this->service = $service;
    }

    public function authEcp(EcpRequest $request){
        return $this->service->authEcp($request->validated());
    }
}
