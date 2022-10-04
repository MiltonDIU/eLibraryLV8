<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        $id = $this->route('item');
        /*   return [
               'publisher_id' => 'required',
               'category_id' => 'required',
               //'item_standard_number_id' => 'required',
               'title' => 'required|max:500',
               //'edition' => 'max:20',
               //'itemStandardNumberValue' => 'max:50',
               //'issue' => 'max:50',
               //'keywords' => 'max:250',
               //'summary' => 'max:1000',
               //'imageUrl' => 'max:250',
               //'uploadImageUrl' => 'max:100|mimes:jpeg,gpeg,png',
               //'publicationYear' => 'numeric|min:1800|max:2030',
               //'pdfUrl' => 'max:50000|mimes:docx,doc,pdf,ppt,mp4',
               //'placeOfPublication' => 'max:100',
           ];

   */

        $rules = [];
        if ($this->request->get('category_id') == 7) {
            //$rules['project_supervisor'] = 'required|max:100';
            $rules['supervisor_id'] = 'required';
            $rules['semester_id'] = 'required';
        }
        $rules['publisher_id'] = 'required';
        $rules['category_id'] = 'required';
        $rules['title'] = 'required|max:500';
        $rules['summary'] = 'max:1000';
        $rules['imageUrl'] = 'max:250';
        $rules['keywords'] = 'max:250';
        $rules['issue'] = 'max:50';

        if ($this->request->get('imageUrl') == null) {
            if ($id==null){
                $rules['uploadImageUrl'] = 'required|mimes:jpeg,jpg,JPG,png|max:1024';
            }else{
                $rules['uploadImageUrl'] = 'mimes:jpeg,jpg,JPG,png|max:1024';
            }
        }else{
            $rules['uploadImageUrl'] = 'mimes:jpeg,jpg,JPG,png|max:1024';
        }
        $rules['pdfUrl'] = 'mimes:docx,doc,pdf,PDF,ppt,mp4,zip,rar|max:512000';
        
        if (($this->request->get('item_standard_number_id')>0) or ($this->request->get('itemStandardNumberValue') != null)) {
            $rules['itemStandardNumberValue'] = 'max:20|min:5|required|unique:items,itemStandardNumberValue,' . $id;
        }
        $rules['itemStandardNumberValue2'] = 'nullable|max:20|min:5|unique:items,itemStandardNumberValue2,' . $id;
        $rules['publicationYear'] = 'numeric|min:1700|max:2040';
        $rules['placeOfPublication'] = 'max:100';
        $rules['authors_ids'] = 'required|array';

        return $rules;
    }

    public function messages()
    {
        return [
            'authors_ids.required'=>'Select author name',
            'publicationYear.max'=>'Publication year must be within 1700 to the current year - '.date('Y'),
            'pdfUrl.max'=>'The upload file  must be less than 500MB',

        ];
    }
}
