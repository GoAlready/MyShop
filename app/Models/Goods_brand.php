<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_brand extends Model
{
    public $timestamps = false;

    protected $table = 'goods_brand';
    // 设置白名单
    protected $fillable = ['brand_name','brand_logo'];
}
