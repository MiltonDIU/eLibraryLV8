<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = $this->route('category');
        return [
            'itemCategory' => 'required|max:50|unique:categories,itemCategory,' . $id,
            //'itemCategoryShort' => 'itemCategoryShort|max:50',
            'accessibilityWithoutAuthentication' => 'required',
            'isVisible' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'itemCategory.required' => 'An Item Category is required',
            // 'itemCategoryShort.required' => 'A sort name is required',
            'accessibilityWithoutAuthentication.required' => 'Accessibility is required yes or not',
            'isVisible.required' => 'is Visible yes or not',
        ];
    }
}
