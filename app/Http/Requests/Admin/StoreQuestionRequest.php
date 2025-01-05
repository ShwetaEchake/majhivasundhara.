<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'competition_type_id'=> 'required',
            'category_id'=> 'required',
            'department_id'=> 'required',
            'question'=> 'required',
            'option'=> 'required',
            'option_marks'=> 'required',
            'link_type'=> 'nullable|required_with:link',
            'link'=> 'nullable',
            'note'=> 'nullable',
        ];
    }
}
