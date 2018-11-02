<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods_brand;
use Validator;
use Storage;

class Goods_brandController extends Controller
{
    public function list()
    {

        $brand = Goods_brand::get()->toArray();

        return view("admin.goods.goods_brand",[
            'brand' => $brand,
        ]);
    }

    public function create()
    {
        return view("admin.goods.brand_add");
    }

    public function add(Request $req)
    {
        
        $brand = new Goods_brand;
        
        $brand->brand_name = $req->brand_name;
        
        $req->validate([
            'brand_logo'=>'required|image|max:2048'
        ],[
            'brand_logo.required'=>'必须上传图片',
            'brand_logo.image' => '只能上传jpeg,png,bmp,gif,or svg格式的图片',
            'brand_logo.max' => '图片最大不能超过2M',
        ]);

        if($req->hasFile('brand_logo') && $req->brand_logo->isValid())
        {
            // 获取当前日期
            $date = date("Ymd");
            // 移动图片到当前日期目录下
            $image = $req->file('brand_logo')->store("/public/".$date);
            $image =  url('/').Storage::url($image);
            $brand->brand_logo = $image;
        }
        // 保存到数据库
        $brand->save();

        return redirect()->route('admin_goods_brandlist');
        
    }

    public function edit()
    {
        $id = $_GET['id'];
        $brand = Goods_brand::find($id)->toArray();

        return view("admin.goods.brand_edit",[
            'brand' => $brand,
        ]);
    }

    public function update(Request $req)
    {
        $id = $_GET['id'];
        $brand = Goods_brand::find($id);
        $brand->brand_name = $req->brand_name;
        $oldimg = "public/".str_replace(url('/')."/storage","",$brand->brand_logo);

        if($req->hasFile('brand_logo') && $req->brand_logo->isValid())
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

        return redirect()->route('admin_goods_brandlist');

    }

    public function delete(Request $req)
    {
        $id = $req->id;
        $brand = Goods_brand::find($id);
        $oldimg = "public/".str_replace(url('/')."/storage","",$brand->brand_logo);
        Storage::delete($oldimg);
        Goods_brand::destroy($id);

        // return redirect()->route('admin_goods_brandlist');
    }

}
