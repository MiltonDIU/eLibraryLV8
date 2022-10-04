<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
        $id = $this->route('author');
        return [
            'authorName' => 'required|max:150',
            //'email' => 'required|max:50|unique:authors,email,'.$id,
            //'slug' => 'required|max:60|unique:authors,slug,' . $id,
        ];
    }
    public function messages()
    {
        return [
            'authorName.required' => 'Author name is required',
        ];
    }
}
