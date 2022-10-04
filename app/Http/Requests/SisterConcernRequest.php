<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SisterConcernRequest extends FormRequest
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
        $id = $this->route('sister_concern');
        return [
            'concernName' => 'required|max:100',
            'emailDomain' => 'required|max:50',
            'concernAuthorityEmail' => 'max:50|unique:sister_concerns,concernAuthorityEmail,'.$id,
        ];
    }
}
