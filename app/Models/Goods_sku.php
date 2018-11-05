<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_sku extends Model
{
    public $timestamps = false;

    protected $table = 'goods_sku';
    // 设置白名单
    protected $fillable = ['goods_id','sku_attr','sku_price','sku_num'];
}
