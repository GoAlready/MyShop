<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'protocol' => 'accepted',
            'username' => 'required|unique:user,username',
            'mobile' => [
                'required',
                'regex:/1\d{10}/',
                'unique:user,mobile',
            ],
            'password' => 'required|min:6|max:12|confirmed',
            'mobile_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已经存在',
            'mobile.required' => '手机号码不能为空',
            'mobile.regex' => '手机号码格式不正确',
            'mobile.unique' => '手机号码已经存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码至少输入六位',
            'password.max' => '密码最多输入十二位',
            'password.confirmed' => '两次输入密码不一致',
            'protocol.accepted' => '请同意协议',
            'mobile_code.required' => '验证码不能为空',

        ];
    }
}
