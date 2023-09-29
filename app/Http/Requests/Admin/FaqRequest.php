<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'title' => 'required|max:50|unique:faqs,title' . $id,
            'body' => 'required',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'            => 'يجب إدخل عنوان',
            'status.required'            => 'يجب إدخل حالة',
            'title.max'            => 'يجب إدخال اقل من 50 حرف',
            'title.unique'            => 'عنوان مدخل من قبل يجب إدخل اسم جديد',
            'body.required'            => 'يجب إدخل محتوي',

        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('اسئلة شائعة', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
