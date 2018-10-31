<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Hash;
class UserController extends Controller
{
    // 返回视图

        // 会员管理

            // 会员列表
            public function getMemberList()
            {
                $users = User::get();
                return view("admin.member.member_list",['users'=>$users]);
            }

    // 数据操作

        // 会员管理

            // 会员列表

                // 会员激活/禁用
                public function memberDisableOrEnable(Request $req)
                {
                    $id = $req->id;
                    $action = $req->action;
                    if($user = User::where('id',$id)->first())
                    {
                        $user->status = $action;
                        if($user->save())
                        return 1;
                    }
                    else
                    return 0;
                }

                // 获取会员信息
                public function getMemberInfo(Request $req)
                {
                    $id = $req->id;
                    if($user = User::where('id',$id)->first())
                    {
                        return $user;
                    }
                    else
                    return 0;
                }

                // 会员信息修改
                public function updateMemberInfo(Request $req)
                {   
                    $id = $req->id;
                    if($user = User::where('id',$id)->first())
                    {

                        // 判断用户名是否被占用
                        if($user->name != $req->name)
                        {
                            $name = User::where('id',$id)->get();
                            if(count($name) > 0)
                            {
                                return ['error'=>"用户名已被使用"];
                            }
                        }
                        // 判断邮箱是否被占用
                        if($user->email != $req->email)
                        {
                            $email = User::where('id',$id)->get();
                            if(count($email) > 0)
                            {
                                return ['error'=>"用户名已被使用"];
                            }
                        }

                        $rules = [
                            'username' => 'required|max:20|min:2',
                            'email' => 'required|email',
                        ];
                        $mes = [
                            'username.required'    => '用户名不能为空',
                            'username.max'    => '用户名最多20位',
                            'username.min'    => '用户名最少2位',
                            'email.required'    => '邮箱地址不能为空',
                            'email.email'    => '邮箱地址格式不正确',
                        ];

                        $validator = Validator::make($req->all(), $rules, $mes);
                        if($errors = $validator->errors()->first())
                        return ['error'=>$errors];

                        if($req->password)
                        {
                            $user->password = Hash::make($req->password);
                        }
                        $user->username = $req->username;
                        $user->email = $req->email;
                        $user->gender = $req->gender;
                        $user->status = $req->status;
                        $user->mobile = $req->mobile;
                        $user->real_name = $req->real_name;
                        if($user->save())
                        {
                            return 1;
                        }
                    }
                    return ['error'=>"用户不存在"];
                }

                // 删除会员
                public function deleteMember(Request $req)
                {
                    $id = $req->id;
                    foreach ($id as $v) {
                        if($user = User::where('id',$v)->first())
                        {
                            $user->delete();
                        }
                    }
                    return 1;
                }

                // 新增会员
                public function memberInsert(Request $req)
                {
                     // 1. 校验 用户用户名 用户邮箱 用户密码 字段
                    $rules = [
                        'username' => 'required|unique:user|max:20|min:2',
                        'email' => 'required|email|unique:user',
                        "password"=>'required|max:32|min:6',
                        "mobile"=>'required',
                    ];
                    $mes = [
                        'username.required'    => '用户名不能为空',
                        'username.unique'    => '用户名已被占用',
                        'username.max'    => '用户名最多20位',
                        'username.min'    => '用户名最少2位',
                        'email.required'    => '邮箱地址不能为空',
                        'email.email'    => '邮箱地址格式不正确',
                        'email.unique'    => '邮箱地址已被占用',
                        'password.required'    => '密码不能为空',
                        'password.max'    => '密码最多32位',
                        'password.min'    => '密码最少6位',
                        'mobile.required'    => '手机号不能为空',
                    ];
                    $validator = Validator::make($req->all(), $rules, $mes);
                    if($errors = $validator->errors()->first())
                    return ['error'=>$errors];

                    $user = new User;
                    $user->password = Hash::make($req->password);
                    $user->username = $req->username;
                    $user->email = $req->email;
                    $user->gender = $req->gender;
                    $user->status = $req->status;
                    $user->mobile = $req->mobile;
                    $user->real_name = $req->real_name;
                    if($user->save())
                    {
                        return 1;
                    }
                }

                
}
