<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mobile' => 'required|size:10',
            'password' => 'nullable|same:confirm_password',
            'image' => "nullable|image",
        ];
    }

    protected $stopOnFirstFailure = true;


    public function messages()
    {
        return [
            'mobile.required'            => 'يجب ان تدخل رقم الجوال',
            'password.required'            => 'يجب ان تدخل كلمة سر',
            'password.confirm_password'            => 'كلمة سر غير متطابق',
            'password.required'            => 'يجب ان تدخل كلمة سر',
            'image.image'                          => 'يجب رفع صورة فقط',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('تعديل حساب شخصي', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
