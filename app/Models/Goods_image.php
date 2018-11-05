<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods_image extends Model
{
    public $timestamps = false;

    protected $table = 'goods_image';
    // 设置白名单
    protected $fillable = ['brand_name','brand_logo'];

    // 单文件上传
    public function upload($good_id)
    {
        $image = $req->cover;
        $oldimg = "public/".str_replace(url('/')."/storage","",$brand->brand_logo);

        if($req->hasFile('cover') && $req->brand_logo->isValid())
        {
            Storage::delete($oldimg);
            // 获取当前日期
            $date = date("Ymd");
            // 移动图片到当前日期目录下
            $image = $req->file('brand_logo')->store("/public/".$date);
            $image =  url('/').Storage::url($image);
            $brand->brand_logo = $image;
        }
        $brand->save();
    }
}
