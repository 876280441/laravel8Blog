<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:4|max:32',
            'email' => 'required|email'
        ];
    }
    /**
     * 获取已定义验证规则的错误消息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '用户名不得为空',
            'name.min' => '用户名不得小于四位',
            'name.max' => '用户名不得大于32位',
            'email.required' => '邮箱必须填写',
            'email.email' => '请填写正确的邮箱格式',
        ];
    }
}
