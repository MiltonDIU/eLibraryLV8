<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class A2zTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('a2z_type');
        return [
            'a2zTypeName' => 'required|max:50|unique:a2z_types,a2zTypeName,' . $id
        ];
    }
}
