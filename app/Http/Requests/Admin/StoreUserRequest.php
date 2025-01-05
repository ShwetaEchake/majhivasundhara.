<?php

namespace App\Http\Requests\Admin;

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
            'tenant_id' => 'required',
            'category_id' => 'required',
            'competition_type_id' => 'required',
            'username' => 'required|max:100',
            'password' => 'required|min:8',
            'ward_id' => 'required|exists:wards,id',
            'role' => 'required',
            'society_telephone' => 'required|unique:users,society_telephone|digits:10',
        ];
    }
}
