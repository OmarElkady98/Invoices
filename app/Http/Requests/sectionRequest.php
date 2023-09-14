<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'section_name'  =>  'required_without:update|string|min:3|unique:sections,section_name, ' .$this->id ,
            'description'   =>  'string|min:5' ,
        ];
    }

    public function messages(): array
    {
        return  [
            'section_name.required_without' =>  'من فضلك قم بإدخال اسم القسم' ,
            'section_name.string'           =>  'يجب ان يكون اسم القسم عباره عن نص' ,
            'section_name.unique'           =>  'هذا القسم موجود بالفعل' ,
            'section_name.min'              =>  'يجب ان يكون عدد احرف القسم اكبر من 3' ,

            'description.string'            =>  'يجب ان يكون الوصف عباره عن حروف' ,
            'description.min'               =>  'يجب ان يكون عدد الحروف اكبر من 5احرف'
        ] ;
    }
}
