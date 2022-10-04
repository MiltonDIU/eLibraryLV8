<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
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
        $id = $this->route('supervisor');
        return [
            'department_id' => 'required',
            'name' => 'required|max:100',
            'email' => 'required|email|max:50|unique:supervisors,email,'.$id,
            'employeeId' => 'required|max:50|unique:supervisors,employeeId,'.$id,
            'mobile' => 'required|max:20',
            'designation' => 'max:50'
        ];
    }
}
