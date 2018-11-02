<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model
{
    public $timestamps = false;

    protected $table = 'admin';
    // 设置白名单
    protected $fillable = ['adminname','password','sex','phone','email','qq'];
    
    public function role()
    {
        return $this->belongsToMany('App\Models\Role','admin_role','admin_id','role_id');
    }
    
    public function getUrl($adminId)
    {
        $url = DB::select("SELECT c.url_path FROM admin_role a LEFT JOIN role_privilege b ON a.role_id=b.role_id LEFT JOIN privilege c ON b.pri_id=c.id WHERE a.admin_id= {$adminId} AND c.url_path!=''");
        // dd($url);
        $ret = [];
        foreach($url as $v)
        {
            // 判断是否有多个url
            if(strpos($v->url_path,',') === false)
            {
                // 如果没有,就直接拿过来
                $ret[] = $v->url_path;
            }
            else
            {
                $path = explode(',',$v->url_path);
                // 合并数组
                $ret = array_merge($ret,$path);
            }
        }
        return $ret;
    }
}
