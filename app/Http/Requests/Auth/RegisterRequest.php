<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name'=>'required|string|min:5',
            'username'=>'required|unique:users,username',
            'email'=>'required|unique:users,email',
            'mobile'=>'required|unique:users,mobile|size:10',
            'password'=>'required|confirmed',
            'image'=>'required|image',
        ];
    }
    public function messages()
    {
        return [
            'name.required'            => 'يجيب ان تدخل اسم',
            'username.unique'            => 'اسم مدخل من قبل يجيب ان تدخل اسم جديد',
            'image.required'            => 'يجيب ان تدخل صورة',
            'image.image'            => ' يجيب ان ترفع صورة',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('تسجيل مستخدم جديد', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
