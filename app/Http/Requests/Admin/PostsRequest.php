<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
            'title'=>'required|string|min:3',
            'description'=>'required',
            'content'=>'required',
            'status'=>'required|in:0,1',
            'comment_able'=>'nullable',
            'category_id'=>'required|numeric|exists:categories,id',
            'tags'=>'required|array',
            'image'=>"required|image"

        ];
    }
    public function messages()
    {
        return [
            'title.required'            => 'يجيب ان تدخل اسم',
            'status.required'            => 'يجيب ان تدخل حالة',
            'description.required'=>"يجب ادخال الوصف",
            'content.required'=>'يجب ادخال المحتوي',
            'category_id.required'=>'يجب ادخال قسم',
            'category_id.in'=>'يجب ان يكون قسم موجد مسبقا',
            'tags.required'            => 'يجيب ان تدخل وسم',
            'image.image'            => ' يجيب ان ترفع صورة',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            alert()->error('مقالات', $validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        });
    }
}
