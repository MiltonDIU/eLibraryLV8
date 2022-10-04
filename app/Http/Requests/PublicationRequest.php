<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
        $id = $this->route('publication');
        return [
            'publisherName' => 'required|max:50',
            'publisherPhone' => 'max:50|unique:publishers,publisherPhone,'.$id,
            'publisherEmail' => 'max:50|unique:publishers,publisherEmail,'.$id,
            'publisherAddress' => 'max:100',
        ];
    }
}
