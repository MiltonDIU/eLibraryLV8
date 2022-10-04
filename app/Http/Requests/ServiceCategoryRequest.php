<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryRequest extends FormRequest
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
        $id = $this->route('service_category');
        return [
            'serviceCategory' => 'required|max:50|unique:service_categories,serviceCategory,'.$id,
            'serviceCategoryShort' => 'required|max:50',
            'accessibilityWithoutAuthentication' => 'required',
            'isVisible' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'serviceCategory.required' => 'A Service Category is required',
            'serviceCategoryShort.required'  => 'A sort name is required',
            'accessibilityWithoutAuthentication.required'  => 'Accessibility is required yes or not',
            'isVisible.required'  => 'is Visible yes or not',
        ];
    }
}
