<?php

namespace App\Http\Requests\livraison;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryRequest extends FormRequest
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
            "description_deliveries"=>"nullable|string",
            "total_deliveries"=>"required|numeric",
            'qty_line_order.*'=>"required|numeric",
            'qty_line_deliverie.*'=>"required|numeric",
            'price_line_deliverie.*'=>"required|numeric",
            'subtotal_line_deliverie.*'=>"required|numeric",
            'products_id.*'=>"required|numeric",
        ];
    }
}
