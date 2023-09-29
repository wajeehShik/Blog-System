<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required|max:50|unique:tags,name' . $id,
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'            => 'يجب إدخل اسم',
            'name.unique'            => 'اسم مدخل من قبل يجب إدخل اسم جديد',
            'status.required'            => 'يجب إدخل الحالة',

        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('وسوم', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
