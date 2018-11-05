<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\AdminLoginRequest;

use App\Models\Admin;

use Hash;

use DB;

class LoginController extends Controller
{
    // 显示登录页面
    public function login()
    {
        return view("admin.login.login");
    }

    // 登录
    public function dologin(AdminLoginRequest $req)
    {
        $admin = Admin::where('adminname',$req->adminname)->first();
        if($admin)
        {
            if(Hash::check($req->password,$admin->password))
            {
                session([
                    'adminid' => $admin->id,
                    'adminname' => $admin->adminname,
                ]);
                $count = DB::select("select count(*) as count from admin_role where role_id = 1 and admin_id = {$admin->id}"); 

                if($count[0]->count > 0)
                {
                    session(['root' => true]);
                }
                else
                {
                    session(['url_path' => $admin->getUrl($admin->id)]);
                }
                return redirect()->route('admin_index');        
            }
           
        }
        else
        {
            return back()->withInput()->withErrors(['adminname'=>'用户名或手机号码不存在']);
        }
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('admin_artlist');
    }
}
