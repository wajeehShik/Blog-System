<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorsRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'status' => 'required',
            'mobile' => 'required|size:10',
            'role' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'            => 'يجب إدخل اسم',
            'email.required'            => 'يجب إدخل ايميل',
            'email.email'            => 'يجب إدخل ايميل بشكل صحيح',
            'email.unique'            => ' ايميل موجود يرجي ادخال ايميل اخر ',
            'password.required'            => 'يجيب إدخل كلمة سر',
            'status.required'            => 'يجيب إدخل حالة',
            'mobile.unique'            => 'يجب إدخال رقم الجوال',
            'mobile.size'            => ' يجب إدخال رقم  الجوال صحيح',
            'role.required'            => 'يجيب إدخل صلاحية',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('مشرفين', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
