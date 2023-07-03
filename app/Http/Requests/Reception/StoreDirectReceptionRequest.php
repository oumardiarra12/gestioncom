<?php

namespace App\Http\Requests\Reception;

use Illuminate\Foundation\Http\FormRequest;

class StoreDirectReceptionRequest extends FormRequest
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
            'description_reception'=>'nullable',
            //'purchase_orders_id'=>'required',
            'total_reception'=>'required',
            'qty_line_reception.*'=>'required',
            'qty_recu_line_reception.*'=>'required',
            'price_line_reception.*'=>'required',
            'subtotal_line_reception.*'=>'required',
            'products_id.*'=>'required',
            'receptions_id.*'=>'required'
        ];
    }
}
