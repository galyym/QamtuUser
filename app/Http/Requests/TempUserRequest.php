<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "nullable|max:255",
            "last_name" => "nullable|max:255",
            "email" => "email|nullable",
            "birthdate" => "date|nullable",
            "phone_number" => "required|string|max:25",
            //-------Документ --------------
            "document_type" => "required|max:255",
            "document_number" => "required|max:255",
            "document_exp" => "required|date|max:255",
            "document_issued" => "required|max:255",
            //-------------------------------
            "family_status" => "required|max:255",
            "address" => "required|max:255",
            "address_reg" => "required|max:255",
            //--------Образования----------
            "education_type" => "required|max:255",
            "education_org" => "required|max:255",
            "education_year_finish" => "required|max:255",
            //----------------------------
            "privilege_id" => "required|numeric|min:1|max:5",
            "positions" => "required|max:255",
            "status_id" => "required|numeric|min:1|max:5",
            //-------Files------------------
            "resume" => "required|mimes:pdf,docx,doc", // Резюме
            "pension_application" => "required|mimes:pdf,docx,doc", // Пенсионное выписка
            "certificate_of_disability" => "mimes:pdf,docx,doc", // Справка инвалидности
            "death_certificate" => "mimes:pdf,docx,doc", // Свидетельство о смерти
            "probation_certificate" => "mimes:pdf,docx,doc", // Справка о наличии на учете пробации
            "verdict_court" => "mimes:pdf,docx,doc", // Приговор суда
        ];
    }
}
