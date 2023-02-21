<?php

namespace App\Services\TempUser;

use App\Http\Responders\Responder;
use App\Models\Document;
use App\Models\RbEducationType;
use App\Models\RbFamilyStatus;
use App\Models\Reference\RbPosition;
use App\Models\Reference\RbPrivilege;
use App\Models\TempUser;
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
            "position" => RbPosition::all()->toArray(),
            "education_type" => RbEducationType::all()->toArray(),
            "family_status" => RbFamilyStatus::all()->toArray()
        ];

        if ($user_info) return $this->response->success("Мәлімет сәтті жіберілді", $user_info);
        return $this->response->error("Белгісіз қателіктер");
    }

    public function sendAppliction($request, $user){
        // добавляем документы пользователя
        $files["temp_user_id"] = $user['id'];
        $files['resume'] = $request['resume']->store('resume/'.$user->iin, 'ftp');
        $files['pension_application'] = $request['pension_application']->store('pension_application/'.$user->iin, 'ftp');
        $files['certificate_of_disability'] = array_key_exists('certificate_of_disability', $request) ? $request['certificate_of_disability']->store('certificate_of_disability/'.$user->iin, 'ftp') : null;
        $files['death_certificate'] = array_key_exists('death_certificate', $request) ? $request['death_certificate']->store('death_certificate/'.$user->iin, 'ftp') : null;
        $files['probation_certificate'] = array_key_exists('probation_certificate', $request) ? $request['probation_certificate']->store('probation_certificate/'.$user->iin, 'ftp') : null;
        $files['verdict_court'] = array_key_exists('verdict_court', $request) ? $request['verdict_court']->store('verdict_court/'.$user->iin, 'ftp') : null;

        $documents = Document::updateOrCreate(
            [
                'temp_user_id' => $user['id']
            ],
            [
                'temp_user_id' => $files["temp_user_id"],
                'resume' => "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['resume'],
                'pension_application' => !empty($files["pension_application"]) ? "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['pension_application'] : null,
                'certificate_of_disability' => !empty($files['certificate_of_disability']) ? "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['certificate_of_disability'] : null,
                'death_certificate' => !empty($files['death_certificate']) ? "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['death_certificate'] : null,
                'probation_certificate' => !empty($files['probation_certificate']) ? "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['probation_certificate'] : null,
                'verdict_court' => !empty($files['verdict_court']) ? "https://cloud.qamtu.kz/e.qamtu.kz/tobirama/".$files['verdict_court'] : null
            ]);

        if(array_key_exists("name", $request) && array_key_exists("last_name", $request) && array_key_exists("patronymic", $request)){
            $full_name = $request['last_name']." ".$request['name']." ".$request["patronymic"];
        } elseif (array_key_exists("name", $request) && array_key_exists("last_name", $request)) {
            $full_name = $request['last_name']." ".$request['name'];
        } else {
            $full_name = $user->full_name;
        }

        // обновляем данные пользователя
        $update_temp_user = TempUser::updateOrCreate(
            [
                'id' => $user->id
            ],
            [
                "full_name" => $full_name,
                "email" => array_key_exists("email", $request) ? $request['email'] : $user->email,
                "birthdate" => array_key_exists("birthdate", $request) ? $request['birthdate'] : $user->birthdate,
                "phone_number" => $request["phone_number"],
                "document_type" => $request['document_type'],
                "document_number" => $request['document_number'],
                "document_exp" => $request['document_exp'],
                "document_issued" => $request['document_issued'],
                "family_status" => $request['family_status'],
                "childs" => array_key_exists('childs', $request) ? $request['childs'] : null,
                "address" => $request['address'],
                "address_reg" => $request['address_reg'],
                "education_type" => $request['education_type'],
                "education_org" => $request['education_org'],
                "education_year_finish" => $request['education_year_finish'],
                "privilege_id" => $request['privilege_id'],
                "positions" => $request['positions'],
                "status_id" => $request['status_id'],
                "last_visit" => Carbon::now()->format('Y-m-d H:i:s'),
                "request_status_id" => 2,
                "document_id" => $documents->id ?? null,
            ]);

        if ($update_temp_user) {
            return $this->response->success("Сәтті өңделді", [
                "document" => $documents,
                "temp_users" => $update_temp_user
            ]);
        }
        return $this->response->error("Белгісіз қателіктер");
    }

}
