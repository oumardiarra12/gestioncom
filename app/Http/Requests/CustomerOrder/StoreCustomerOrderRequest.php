<?php

namespace App\Http\Requests\CustomerOrder;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerOrderRequest extends FormRequest
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
            "total_customer_order"=>'required|numeric',
            "description_customer_order"=>'nullable|string',
            "customers_id"=>"required",
            "qty_line_customer_order.*"=>"required",
            "price_line_customer_order.*"=>"required",
            "subtotal_line_customer_order.*"=>"required",
            "products_id.*"=>"required",
            "customer_orders_id.*"=>"required"
        ];
    }
}
