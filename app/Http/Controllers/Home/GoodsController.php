<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Goods_image;
use Storage;

class GoodsController extends Controller
{
    public function good()
    {
        $id = $_GET['id'];
        $goods = Goods_image::where('goods_id',$id)->get()->toArray();
        // dd($images);

        return view("home.goods.item",[
            'goods' => $goods,
        ]);
    }

    public function search()
    {
        $id = $_GET['id'];
        $good = Goods::where('type3_id',$id)->get()->toArray();

        return view("home.goods.search",[
            'good' => $good[0],
        ]);
    }
}
