<?php

namespace App\Http\Requests\Comptoir;

use Illuminate\Foundation\Http\FormRequest;

class StoreComptoirRequest extends FormRequest
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
            "customers_id"=>"required",
            "total_comptoir"=>"required|numeric",
            "qty_linecomptoir.*"=>"required|numeric",
            "price_linecomptoir.*"=>"required|numeric",
            "subtotal_linecomptoir.*"=>"required|numeric",
            "products_id.*"=>"required"
        ];
    }
}
