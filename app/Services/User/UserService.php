<?php

namespace App\Services\User;

use App\Models\Ranging;
use App\Models\RangingLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Responders\Responder;

class UserService
{
    protected $response;
    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getUserLog(){
        $data = [
            "user_id" => Auth::id(),
            "raiting" => Auth::user()->raiting_number,
            "resume_last_log" => RangingLog::where('ranging_logs.ranging_id', Ranging::where('applicant_id', Auth::id())->value('id'))->with(['ranging', 'company', 'status'])->get()
        ];

        return $this->response->success('success', $data);
    }
}
