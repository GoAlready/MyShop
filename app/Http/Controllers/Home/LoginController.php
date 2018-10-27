<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;

use App\Models\User;

use Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('home.user.login');
    }

    public function dologin(LoginRequest $req)
    {
        $user = User::where('mobile',$req->username)
                        ->orwhere('username',$req->username)
                        ->first();
        if($user)
        {
            if(Hash::check($req->password,$user->password))
            {
                session([
                    'id' => $user->id,
                    'username' => $user->username,
                ]);
                return redirect()->route('home_index');
            }
            else
            {
                return back()->withInput()->withErrors(['password'=>['密码输入错误']]);
            }
        }
        else
        {            
            return back()->withInput()->withErrors(['password'=>['用户名或手机号码不存在']]);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home_index');
    }
}
