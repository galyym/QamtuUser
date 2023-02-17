<?php

namespace App\Services\TempUser;

use App\Http\Responders\Responder;
use App\Models\Document;
use App\Models\Reference\RbPosition;
use App\Models\Reference\RbPrivilege;
use Carbon\Carbon;

class TempUserService
{
    protected $response;

    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getInfoAppliction($user){
        $user_info = [
            "full_name" => $user['full_name'],
            "iin" => $user['iin'],
            "birthdate" => $user['birthdate'],
            "privilege" => RbPrivilege::get()->toArray(),
            "position" => RbPosition::all()->toArray()
        ];
        return $this->response->success("success", $user_info);
    }

    public function sendAppliction($request, $user){

        // добавляем документы пользователя
        $files = [];
        $files["temp_user_id"] = $user['id'];
        $files['resume'] = $request['resume']->store('resume/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp');
        $files['pension_application'] = $request['pension_application']->store('pension_application/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp');
        $files['certificate_of_disability'] = array_key_exists('certificate_of_disability', $request) ? $request['certificate_of_disability']->store('certificate_of_disability/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp') : null;
        $files['death_certificate'] = array_key_exists('death_certificate', $request) ? $request['death_certificate']->store('death_certificate/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp') : null;
        $files['probation_certificate'] = array_key_exists('probation_certificate', $request) ? $request['probation_certificate']->store('probation_certificate/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp') : null;
        $files['verdict_court'] = array_key_exists('verdict_court', $request) ? $request['verdict_court']->store('verdict_court/'.Carbon::now()->format('Y')."/".Carbon::now()->format('m')."/".Carbon::now()->format('d'), 'ftp') : null;

        $documents = Document::updateOrCreate($files);

        // обновляем данные пользователя


        return $this->response->success("success", $documents);
    }

}
