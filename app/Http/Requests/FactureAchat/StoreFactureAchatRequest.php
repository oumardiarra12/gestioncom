<?php

namespace App\Http\Requests\FactureAchat;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactureAchatRequest extends FormRequest
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
            'total_purchase_invoice'=>'required',
            'description_purchase_invoice'=>'nullable',
            // 'receptions_id'=>'required',
            'qty_line_purchase_invoice.*'=>'required',
            'price_purchase_invoice.*'=>'required',
            'subtotal_purchase_invoice.*'=>'required',
            'products_id.*'=>'required',
            'purchase_invoices_id.*'=>'required',
        ];
    }
}
