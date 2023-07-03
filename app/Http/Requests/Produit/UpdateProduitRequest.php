<?php

namespace App\Http\Requests\Produit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
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
            'image_product'=>'nullable',
            'codebarre_product'=>'nullable',
            'name_product'=>'required',
            'price_sale'=>'required|numeric',
            'price_purchase'=>'required|numeric',
            'stock_min'=>'required',
            'stock_actuel'=>'nullable',
            'description_product'=>'nullable',
            'category_id'=>'required',
            'units_id'=>'required'
        ];
    }
}
