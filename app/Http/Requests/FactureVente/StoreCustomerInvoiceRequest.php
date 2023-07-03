<?php

namespace App\Http\Requests\FactureVente;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerInvoiceRequest extends FormRequest
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
            "total_customer_invoices"=>"required|nullable",
            "description_customer_invoices"=>"nullable|string",
            "products_id.*"=>"required",
            "qty_line_customer_invoice.*"=>"required|numeric",
            "price_line_customer_invoice.*"=>"required|numeric",
            "subtotal_line_customer_invoice.*"=>"required|numeric"
        ];
    }
}
