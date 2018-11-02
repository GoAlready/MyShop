<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_type extends Model
{
    public $timestamps = false;

    protected $table = 'goods_type';
    // 设置白名单
    protected $fillable = ['name','pid'];
    // 关联模型取三级分类
    public function level2()
    {
        return $this->hasMany('App\Models\Goods_type','pid','id');
    }

    public function level()
    {
        return $this->hasMany('App\Models\Goods_type','pid','id')->with('level2');
    }
}
