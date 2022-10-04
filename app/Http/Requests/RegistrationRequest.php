<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
        $id = $this->route('register');
        return [
            'name' => 'required|max:50',
            'username' => 'required|max:20|unique:users,username,'.$id,
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'required|min:6|confirmed',
            'member_type' => 'required',
            'sister_concern_id' => 'required_if:member_type,==,Concern'
        ];
    }
}
