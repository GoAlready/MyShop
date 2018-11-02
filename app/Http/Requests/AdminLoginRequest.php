<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'adminname' => 'required',
            'password' => 'required|min:6|max:12',
        ];
    }

    public function messages()
    {
        return [
            'adminname.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
            'password.min' => '密码至少输入六位',
            'password.max' => '密码最多输入十二位',
        ];
    }
}
