<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            "email" => "required_without_all:phone|email|exists:applicant,email",
            "phone" => "required_without_all:email|numeric|exists:applicant,phone_number",
            "iin" => "required|numeric|exists:applicant,iin|min:12",
        ];
    }
}
