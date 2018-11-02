<?php

namespace App\Http\Middleware;

use Closure;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session('adminid'))
        {
            return redirect()->route("admin_login");
        }
        if (session('root')){
          
        }
        else
        {
            // 获取要访问的路径
            $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/admin';

            // 设置一个白名单
            $whiteList = ['/admin','/admin/logout'];
            // 判断是否有访问的权限
            if(!in_array($path,array_merge($whiteList,session('url_path'))))
            {
                die("无权访问!");
            }

        }
        

        return $next($request);
    }
}
