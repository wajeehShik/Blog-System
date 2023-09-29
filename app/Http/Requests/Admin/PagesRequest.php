<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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

        return [
            'key' => 'required|max:50|unique:pages,key' . $id,
            'value' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'key.required'            => 'يجيب ان تدخل اسم',
            'key.max'            => 'يجب إدخال اقل من 50 حرف في اسم',
            'key.unique'            => 'اسم مدخل من قبل يجيب ان تدخل اسم جديد',
            'value.required'            => 'يجيب ان تدخل محتوي',
            'status.required'            => 'يجيب ان تدخل الحالة',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('صفحات الثابتة', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
