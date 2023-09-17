<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          =>  'required_without:update|string' ,
            'section_id'    =>  'required'
        ];
    }

    public function messages(): array
    {
        return  [
            'name.required_without' =>  'من فضلك قم بإدخال اسم المنتج' ,
            'name.string'           =>  'يجب ان يكون اسم المنتج عباره عن نص' ,

            'section_id.required'   =>  'من فضلك قم بتحديد القسم' ,
        ] ;
    }
}
