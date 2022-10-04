<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
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

        $id = $this->route('semester');
        return [
            'name' => 'required|max:20',
            'code' => 'max:3|unique:semesters,code,'.$id,
            'semester_year' => 'max:4'
        ];
    }

    public function messages()
    {

        return [
            'code.unique' => 'Semester code already exist'
        ];
    }
}
