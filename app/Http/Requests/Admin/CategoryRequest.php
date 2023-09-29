<?php

namespace App\Http\Requests\Admin;

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
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $id = strpos(request()->route()->uri, 'update') ? ',' . request()->id : '';

        $image = strpos(request()->route()->uri, 'update') ?   'nullable' : 'required';

        return [
            'name' => 'required|max:50|unique:categories,name' . $id,
            'status' => 'required',
            'image' =>   $image . '|image'
        ];
    }
    public function messages()
    {
        return [
            'name.required'            => 'يجيب ان تدخل اسم',
            'status.required'            => 'يجيب ان تدخل حالة',
            'name.max'            => 'يجيب ان  ادخال اقل من 50 حرف',
            'name.unique'            => 'اسم مدخل من قبل يجيب ان تدخل اسم جديد',
            'image.required'            => 'يجيب ان تدخل صورة',
            'image.image'            => ' يجيب ان ترفع صورة',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('تصنيفات', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
