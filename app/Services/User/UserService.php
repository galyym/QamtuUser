<?php

namespace App\Services\User;

use App\Http\Resources\Ranging\RangingLogResource;
use App\Http\Resources\User\ApplicantResource;
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

        $user = Auth::user();
        $log = RangingLog::where('ranging_logs.ranging_id', Ranging::where('applicant_id', $user->id)
            ->value('id'))
            ->with(['ranging', 'company', 'status'])
            ->get();

        $data = [
            "user" => new ApplicantResource($user),
            "raiting" => $user->raiting_number,
//            "resume_last_log" => RangingLogResource::collection(RangingLog::where('ranging_logs.ranging_id', RangingResource::where('applicant_id', Auth::id())->value('id'))->with(['ranging', 'company', 'status'])->get())
            "history" => $log
        ];

        return $this->response->success('success', $data);
    }
}
