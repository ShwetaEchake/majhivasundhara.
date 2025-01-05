<?php

namespace App\Http\Requests\Field;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePDFormRequest extends FormRequest
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
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'images' => 'nullable',
            'description' => 'required',
            'marks' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => 'Latitude is required',
            'longitude.required' => 'Longitude is required'
        ];
    }
}
