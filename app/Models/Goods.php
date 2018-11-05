<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $timestamps = false;

    protected $table = 'goods';
    // 设置白名单
    protected $fillable = ['goods_name','description','type1_id','type2_id','type3_id','brand_id'];

}
