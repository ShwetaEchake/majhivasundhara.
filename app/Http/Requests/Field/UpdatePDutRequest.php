<?php

namespace App\Http\Requests\Field;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePDutRequest extends FormRequest
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
            'user_contest_id' => 'required',
            'contestant_user_id' => 'required',
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'activity' => 'required',
            'file' => 'nullable',
        ];
    }
}
