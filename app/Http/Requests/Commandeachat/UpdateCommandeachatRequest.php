<?php

namespace App\Http\Requests\Commandeachat;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandeachatRequest extends FormRequest
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
            // 'stats_purchase_order'=>'required',
            'description_purchase_order'=>'nullable',
            'total_purchase_order'=>'required|numeric',
            'suppliers_id'=>'required',
            'qty_line_purchase_order.*'=>'required|numeric',
            'price_line_purchase_order.*'=>'required|numeric',
            'subtotal_line_purchase_order.*'=>'required|numeric',
            'products_id.*'=>'required',
        ];
    }
}
