<?php

namespace App\Http\Requests\Fournisseur;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFournisseurRequest extends FormRequest
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
            'name_supplier'=>'required',
            'tel_supplier'=>'required',
            'address_supplier'=>'required',
            'email_supplier'=>'required|email',
            'firstname_contact_supplier'=>'required',
            'lastname_contact_supplier'=>'required',
            'tel_contact_supplier'=>'required',
            'email_contact_supplier'=>'required|email',
            'description_supplier'=>'nullable',
        ];
    }
}
