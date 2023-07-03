<?php

namespace App\Http\Requests\Estimate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstimateRequest extends FormRequest
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
            "description_estimates"=>"nullable|string",
            "total_estimates"=>"required|numeric",
            "qty_line_estimate.*"=>"required|numeric",
            "price_line_estimate.*"=>"required|numeric",
            "subtotal_line_estimate.*"=>"required|numeric",
            "products_id.*"=>"required|numeric"
        ];
    }
}
