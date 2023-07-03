<?php

namespace App\Http\Requests\CustomerPayement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerPaymentRequest extends FormRequest
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
            'amount_to_be_paid'=>'required|numeric',
            'amount_to_pay'=>'required|numeric',
            'reste'=>'required|numeric',
            'description_customer_payment'=>'nullable'
        ];
    }
}
