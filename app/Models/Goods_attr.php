<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_attr extends Model
{

    public $timestamps = false;

    protected $table = 'goods_sku_attr';
    // 设置白名单
    protected $fillable = ['attr','pid','goods_id'];

    // 增加商品属性以及属性值     
    public static function addAttr($req,$id){     
        $data = array_unique($req->attr);
           $color = [];
           $size = [];
           foreach($data as $v){
               if(strstr($v,"颜色")){
                   $color[]= $v;
               }else{
                   $size[] = $v;
               }
           }
       $colorId = goods_attr::insertGetId(['attr'=>'颜色','pid'=>0,'goods_id'=>$id]);
       $sizeId = goods_attr::insertGetId(['attr'=>'尺寸','pid'=>0,'goods_id'=>$id]);
       foreach($color as $v){
            goods_attr::insert(['attr'=>$v,'pid'=>$colorId,'goods_id'=>$id]);
       }
       foreach($size as $v){
            goods_attr::insert(['attr'=>$v,'pid'=>$sizeId,'goods_id'=>$id]);
       }
    }

}
