<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:4|max:32',
            'content' => 'required|min:4',
            'category_id' => 'required|gt:0'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题必须填写',
            'title.min' => '标题最少4个字符',
            'title.max' => '标题最大32个字符',
            'content.required' => '内容必须填写',
            'content.min' => '内容最少4个字符',
            'category_id.required' => '分类必填',
            'category_id.gt' => '分类必填'
        ];
    }
}
