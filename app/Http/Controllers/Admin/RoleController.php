<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Privilege;

class RoleController extends Controller
{
    public function list()
    {
        $role = Role::with('privilege')->get()->toArray();

        return view("admin.role.role_list",[
            'role' => $role,
        ]);

    }

    public function create()
    {
        $privilege = Privilege::with('level')->where('parent_id',0)->get()->toArray();
        return view("admin.role.role_add",[
            'pri' => $privilege,
        ]);
    }

    public function add(Request $req)
    {
        $role = new Role;
        $role->fill($req->all());
        $role->save();
        // 添加到关联表
        // dd($req->pri_id);
        if($req->pri_id){
            $role->privilege()->attach($req->pri_id);
        }
        // 跳转到列表页
        return redirect()->route('admin_rolelist');
    }

    public function edit()
    {
        $id = $_GET['id'];
        // 根据当前角色的数据模型
        $role = Role::find($id);
        // 关联模型获取当前角色所拥有权限的ID
        $prids = $role->privilege()->get(['pri_id'])->toArray();
        // 获取所有的权限
        $privilege = Privilege::with('level')->where('parent_id',0)->get()->toArray();
        // 把二维数组转换成一维
        $pri_id = [];
        foreach($prids as $v)
        {
            $pri_id[] = $v['pri_id'];
        }
       
        return view("admin.role.role_edit",[
            'role' => $role,
            'pri_id' => $pri_id,
            'pri' => $privilege,
        ]);
    }

    public function update(Request $req)
    {
        $id = $_GET['id'];
        $role = Role::find($id);
        // 删除中间表和角色有关的数据
        $role->privilege()->detach();
        
        $role->fill($req->all());
        $role->save();
        // 添加到中间表
        if($req->pri_id)
        {
            $role->privilege()->attach($req->pri_id);
        }

        return redirect()->route('admin_rolelist');
    }
    
    public function delete()
    {
        $id = $_GET['id'];
        // 找出管理员数据
        $role = Role::find($id);
        // 删除关联表关联的数据
        $role->privilege()->detach();
        $role->destroy($id);
        return redirect()->route('admin_prilist');
    }

}


