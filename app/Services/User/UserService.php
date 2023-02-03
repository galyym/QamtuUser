<?php

namespace App\Services\User;

use App\Http\Resources\Ranging\RangingLogResource;
use App\Http\Resources\User\ApplicantResource;
use App\Http\Resources\User\RaitingListResource;
use App\Http\Resources\User\UserListResource;
use App\Models\Ranging;
use App\Models\RangingLog;
use App\Models\User;
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
            "privilege_raiting" => $user->raiting_privilege_number ?? $user->raiting_number,
            "history" => RangingLogResource::collection($log),
            "raiting_number" => $this->getUserQueue($user)
        ];

        return $this->response->success('success', $data);
    }

    public function getUserQueue($user){
        $raiting_privilege_number = $user->raiting_privilege_number;
        $raiting_table_name = "raiting_privilege_number";

        // bad logic here TODO::fix here
        if ($raiting_privilege_number == null){
            $raiting_number = $user->raiting_number;
            $raiting_table_name = "raiting_number";

            if ($raiting_number < 5 && $raiting_number > 0){
                $raiting_list = $user->where($raiting_table_name, '<=', intval($raiting_number)+5, 'and')->get();
            } else {
                $raiting_list = $user->where($raiting_table_name, '<=', intval($raiting_number)+5, 'and')
                    ->where($raiting_table_name, '>=', intval($raiting_number)-5, "and")
                    ->orderBy($raiting_table_name, 'asc')
                    ->get();
            }
        } else {
            if ($raiting_privilege_number < 5 && $raiting_privilege_number > 0){
                $raiting_list = $user->where($raiting_table_name, '<=', intval($raiting_privilege_number)+5, 'and')->where('privilege_id', $user->privilege_id)->get();
            } else {
                $raiting_list = $user->where($raiting_table_name, '<=', intval($raiting_privilege_number)+5, 'and')
                    ->where($raiting_table_name, '>=', intval($raiting_privilege_number)-5, "and")
                    ->where('privilege_id', $user->privilege_id)
                    ->orderBy($raiting_table_name, 'asc')
                    ->get();
            }
        }


        return RaitingListResource::collection($raiting_list);
    }

    public function getUserList(){
        $data = UserListResource::collection(User::where('status_id', '!=', 4)->orderBy('id', 'asc')->with('privilege')->get());
        return $this->response->success('success', $data);
    }


}
