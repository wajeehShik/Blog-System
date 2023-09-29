<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name' . $id,
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'            => 'يجب إدخل اسم',
            'name.unique'            => 'اسم مدخل من قبل يجب إدخل اسم جديد',
            'permission.required'            => 'يجب إدخل صلاحيات',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('صلاحيات', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
