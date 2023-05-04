<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'image'=>"nullable|image|mimes:png,jpg,jpeg|max:2048",
            'telephone'=>'required',
            'addresse'=>'required',
            'category_users_id'=>'required',
            'email'=>'required|unique:users,email,id',
            'password'=>'required|confirmed'
        ];
    }
}
