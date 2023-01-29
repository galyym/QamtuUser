<?php

namespace App\Services\User;

use App\Models\Ranging;
use App\Models\RangingLog;
use App\Models\Redirect;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUserLog(){

        $ranging = Ranging::where('ranging_id', '=', Auth::id());

        $data = [
            "user_id" => Auth::id(),
            "raiting" => Auth::user()->raiting_number,
            "resume_last_log" => $rangingLogs = RangingLog::where('ranging_logs.ranging_id', Ranging::where('applicant_id', Auth::id())->value('id'))->with(['ranging', 'company', 'status'])->get()
        ];

        return $data;
    }
}
