<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
            'name'=>'required|max:50',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'            => 'يجيب ان تدخل اسم',
            'name.max'            => 'يجيب ان  ادخال اقل من 50 حرف',
            'email.required'  =>"يجب إدخال ايميل",
            'subject.required'=>"يجب إدخال عنوان",
            'message.required'=>"يجب إدخال رسالة"
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('طلب تواصل', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
