<?php

namespace App\Http\Requests\ReturnCustomer;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnCustomerRequest extends FormRequest
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
            "description_return_customer"=>"nullable|string",
            "total_return_customer"=>"required|numeric",
            "customers_id"=>"required|numeric",
            "qty_line_return_customer.*"=>"required|numeric",
            "price_return_customer.*"=>"required|numeric",
            "subtotal_return_customer.*"=>"required|numeric",
            "products_id.*"=>"required|numeric",
            "return_customers_id.*"=>"required|numeric"
        ];
    }
}
