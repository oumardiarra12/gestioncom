<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name'=>'required',
            'company_sigle'=>'required',
            'company_status'=>'nullable',
            'company_nif'=>'nullable',
            'company_contact'=>'required',
            'company_email'=>'required',
            'company_bp'=>'nullable',
            'company_fax'=>'nullable',
            'company_address'=>'required',
            'company_activity'=>'nullable',
            'company_logo'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
