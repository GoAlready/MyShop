<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $table = 'user';
    // 设置白名单
    protected $fillable = ['username','mobile','password'];
    // 隐藏的字段
    protected $hidden = ['password'];
    // 关联积分表
    public function points()
    {
        return $this->hasOne('App\Models\UserPoints','user_id','id');
    }
}
