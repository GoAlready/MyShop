<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\Role;
use Hash;
use DB;


class AdminController extends Controller
{
    public function list()
    {
        $role = Role::get();
        if(isset($_GET['id']) && @$_GET['id'])
        {
            $id = $_GET['id'];
            $admin = DB::select("select a.*,GROUP_CONCAT(c.role_name) pri_list from admin as a join admin_role as b on a.id = b.admin_id  join role as c on b.role_id = c.id where b.role_id = {$id} group by a.id");            
        }
        else
        {
            $admin = DB::select("select a.*,GROUP_CONCAT(c.role_name) pri_list from admin as a join admin_role as b on a.id = b.admin_id  join role as c on b.role_id = c.id group by a.id");
        }
        
        $num = count(DB::select("select a.*,GROUP_CONCAT(c.role_name) pri_list from admin as a join admin_role as b on a.id = b.admin_id  join role as c on b.role_id = c.id group by a.id"));

        return view("admin.admin.admin_list",[
            'admin' => $admin,
            'role' => $role,
            'num' => $num,
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

    public function edit($id)
    {
        $role = Role::get();
        $admin = Admin::find($id);
        $roles = $admin->role()->get(['role_id']);
        $role_id = [];
        foreach($roles as $v)
        {
            $role_id[] = $v['role_id'];
        }
        return view("admin.admin.admin_edit",[
            'role' => $role,
            'admin' => $admin,
            'role_id' => $role_id,
        ]);
    }

    public function update(Request $req,$id)
    {

        $message = Admin::find($id);
        // 删除中间表和管理员有关的id
        $message->role()->detach();
        // 获取表单所有数据
        $message->fill($req->all());
        $message->save();

        // 添加到中间表
        if($req->role_id)
        {
            $message->role()->attach($req->role_id);
        }
        return redirect()->route('admin_adminlist');

    }

    public function delete()
    {
        $id = $_GET['id'];
        // 找出管理员数据
        $admin = Admin::find($id);
        // 删除关联表关联的数据
        $admin->role()->detach();
        // 删除管理员
        $admin->destroy($id);
        return redirect()->route('admin_adminlist');
    }
}
