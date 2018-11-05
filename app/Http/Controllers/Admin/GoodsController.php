<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Goods;
use App\Models\Goods_type;
use App\Models\Goods_brand;
use App\Models\Goods_image;
use App\Models\Goods_sku;




class GoodsController extends Controller
{
    public function list()
    {
        $good = Goods::get()->toArray();
        // dd($good);
        return view("admin.goods.goods_list",[
            'good' => $good,
        ]);
    }

    public function create()
    {
        $type = new Goods_type;
        $type = $type->getcate();

        return view("admin.goods.goods_add",[
            'type' => $type,
        ]);
    }

    public function add(Request $req)
    {
        $good = Goods::create($req->all());
        // 获取到商品的id
        $good_id = $good['id'];
        // 获取到sku,拼接到一起
        $arr = $req->attr;
        for($i = 0;$i<count($arr);$i++){
            if($i%2!=0)
            {
                $sku[$i]=$arr[$i-1].$arr[$i];
            }
        }
        sort($sku);
        for($i = 0;$i<count($sku);$i++)
        {             
            $price = $req->price[$i];
            $num = $req->count[$i];
            $attr = $sku[$i];
            Goods_sku::insert(['goods_id'=>$good_id,'sku_attr'=>$attr,'sku_price'=>$price,'sku_num'=>$num]); 
        }
        return redirect()->route('admin_goodslist');  
    }
    public function ajax_getcate()
    {
        $id = $_GET['id'];
        $data = new Goods_type;
        $data = $data->getcate($id);

        echo json_encode($data);
    }
    public function ajax_getbrand()
    {
        $id = $_GET['id'];
        $brand = Goods_brand::join('goods_brand_type','goods_brand_type.brand_id','goods_brand.id')->where('goods_brand_type.type_id',$id)->get();
        
        return $brand;
    }
}
