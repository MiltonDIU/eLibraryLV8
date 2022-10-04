<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class A2zDatabaseRequest extends FormRequest
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
        $id = $this->route('a2z_database');
        return [
            'a2z_type_id' => 'required|integer',
            'a2z_vendor_id' => 'required|integer',
            'a2zTitle' => 'required|max:100|unique:a2z_databases,a2zTitle,' . $id,
            'a2zDescription' => 'max:1000',
            'redirectLink' => 'max:1000',

        ];
    }
}
