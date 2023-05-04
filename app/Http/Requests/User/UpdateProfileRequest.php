<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'firstname'=>'required',
            'lastname'=>'required',
            'image'=>"nullable",
            'telephone'=>'required',
            'addresse'=>'required',
            'password'=>'nullable|confirmed',
            'email'=>'required|unique:users,email,'.$this->id,
        ];
    }
}
