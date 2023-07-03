<?php

namespace App\Http\Requests\RetourAchat;

use Illuminate\Foundation\Http\FormRequest;

class StoreRetourAchatRequest extends FormRequest
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
            'description_return_purchase'=>'nullable',
            'total_return_purchase'=>'required',
            'suppliers_id'=>'required',
            'qty_line_return_purchase.*'=>'required',
            'price_return_purchase.*'=>'required',
            'subtotal_return_purchase.*'=>'required',
            'products_id.*'=>'required',
            'return_purchases_id.*'=>'required'
        ];
    }
}
