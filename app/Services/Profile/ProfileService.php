<?php

namespace App\Services\Profile;

use App\Http\Responders\Responder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    protected $response;
    public function __construct(Responder $response){
        $this->response = $response;
    }

    public function getProfile(){
        $profile = User::with(['status', 'privilege'])->where('id', Auth::id())->get();
        return $this->response->success('Profile', $profile);
    }
}
