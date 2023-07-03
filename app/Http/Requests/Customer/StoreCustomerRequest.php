<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'firstname_customer'=>'required',
            'lastname_customer'=>'required',
            'tel_customer'=>'required|numeric',
            'email_customer'=>'required|email',
            'address_customer'=>'required',
            'description_customer'=>'nullable'
        ];
    }
}