<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;

use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Cache;

use Flc\Dysms\Client;

use Flc\Dysms\Request\SendSms;

use Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('home.user.register');
    }

    public function doregister(RegisterRequest $req)
    {
        // 拼出缓存的名字
        $name = 'code-'.$req->mobile;
        // 取出缓存的验证码
        $code = Cache::get($name);

        if(!$code || $code != $req->mobile_code)
        {
            return back()->withErrors(['mobile_code' => '验证码错误!']);
        }
        // 密码加密
        $password = Hash::make($req->password);
        // 创建User对象
        $user = new User;
        // 把表单中的数据设置到模型
        $user->username = $req->username;
        
        $user->mobile = $req->mobile;
        $user->password = $password;
        // 把数据保存到表中
        $user->save();
        // 跳转到登录页
        return redirect()->route('home_login');
    }

    public function send_mobile(Request $req)
    {
        // 生成随机验证书
        $code = rand(100000,999999);

        // 缓存时的名字
        $name = 'code-'.$req->mobile;
        // 把随机数缓存起来(有效时间为1分钟)
        Cache::put($name,$code,1);

        $config = [
            'accessKeyId'    => 'LTAIlY6JCxNR9oyV',
            'accessKeySecret' => 'hLOg6TowmNHibhgEhSQsqEOe4QSogY',
        ];
        
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($req->mobile);
        $sendSms->setSignName('全栈sns');
        $sendSms->setTemplateCode('SMS_135033803');
        $sendSms->setTemplateParam(['code' => $code]);
    
        $client->execute($sendSms);

    }
}
