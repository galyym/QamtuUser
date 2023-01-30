<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService as Service;

class UserController extends Controller
{
    protected $service;

    public function __construct(Service $service){
        $this->service = $service;
    }

    public function getUserLog(){
        return $this->service->getUserLog();
    }
}
