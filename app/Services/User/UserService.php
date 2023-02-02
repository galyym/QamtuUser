<?php

namespace App\Services\User;

use App\Http\Resources\Ranging\RangingLogResource;
use App\Http\Resources\User\ApplicantResource;
use App\Http\Resources\User\RaitingList;
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
            "history" => RangingLogResource::collection($log),
            "raiting_number" => $this->getUserQueue($user)
        ];

        return $this->response->success('success', $data);
    }

    public function getUserQueue($user){
        $raiting = $user->raiting_number;

        $raiting_list = [];
        if ($raiting < 5 && $raiting > 0){
            $raiting_list = $user->where('raiting_number', '<=', intval($raiting)+5)->get();
        } else {
            $raiting_list = $user->where('raiting_number', '<=', intval($raiting)+5, 'and')
                ->where('raiting_number', '>=', intval($raiting)-5,)
                ->orderBy('raiting_number', 'asc')
                ->get();
        }
        return RaitingList::collection($raiting_list);
    }
}
