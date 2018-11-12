<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Storage;

use Image;

class Goods_image extends Model
{
    public $timestamps = false;

    protected $table = 'goods_image';
    // 设置白名单
    protected $fillable = ['goods_id','small','mind','big'];

    // 多文件上传
    public function upload($req,$goods_id)
    {
        $image = $req->image;
        
        foreach($image as $k=>$v)
        {
            if($req->hasFile('image') && $req->image[$k]->isValid())
            {
                // 获取当前日期
                $date = date("Ymd");
                // 移动图片到当前日期目录下
                $image = $req->file('image')[$k]->store("/public/smimg/".$date);
                // 获取每张图片的路径
                $path = $req->image[$k]->path();
                Image::configure(array('driver'=>'gd'));
                // 创建图片对象
                $img = Image::make($path);

                // 生成中缩略图
                $img->resize(400,null,function($c)
                {
                    $c->aspectRatio();
                });
                $mdimage = str_replace('public/smimg/'.$date,'public/mdimg/'.$date,$image);
                @mkdir(storage_path('app/public/mdimg/'.$date),0777,true);
                $img->save(storage_path('app/'.$mdimage));

                // 生成大缩略图
                $img->resize(800,null,function($c)
                {
                    $c->aspectRatio();
                });
                $bigimage = str_replace('public/smimg/'.$date,'public/bigimg/'.$date,$image);
                @mkdir(storage_path('app/public/bigimg/'.$date),0777,true);
                $img->save(storage_path('app/'.$bigimage));

                Goods_image::insert(['goods_id' => $goods_id,'small'=>$image,'mind'=>$mdimage,'big'=>$bigimage]);
            }
        }        

    }
}
