<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Goods_type;

class IndexController extends Controller
{
    public function index()
    {
        $type = Goods_type::with('level')->where('pid',0)->get()->toArray();
        // dd($type);
        return view('home.index.index',[
            'type' => $type,
        ]);
    }
}
