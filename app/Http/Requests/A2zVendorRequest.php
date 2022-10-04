<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class A2zVendorRequest extends FormRequest
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
        $id = $this->route('a2z_vendor');
        return [
            'a2zVendorName' => 'required|max:150|unique:a2z_vendors,a2zVendorName,' . $id
        ];
    }
}
