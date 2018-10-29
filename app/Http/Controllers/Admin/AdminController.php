<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\Role;
use Hash;


class AdminController extends Controller
{
    public function list()
    {
        $admin = Admin::with('role')->get()->toArray();
        $role = Role::get();
        // dd($admin);
        return view("admin.admin.admin_strator",[
            'admin' => $admin,
            'role' => $role,
        ]);
    }
    public function add(Request $req)
    {
        $admin = new Admin;
        // 填充到模型
        $admin->fill($req->all());
        // 密码加密
        $admin->password = Hash::make($req->userpassword);
        $admin->save();
        // 添加到关联表
        if($req->role_id)
        {
            $admin->role()->attach($req->role_id);
        }
        // 跳转到列表页
        return redirect()->route('admin_adminlist');
    }

    public function edit()
    {
        $role = Role::get();
        return view("admin.admin.admin_stredit",[
            'role' => $role,
        ]);
    }

    public function update()
    {
        
    }
}
