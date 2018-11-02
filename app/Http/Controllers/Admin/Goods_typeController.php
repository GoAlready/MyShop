<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods_type;

class Goods_typeController extends Controller
{
    public function list()
    {
        $type = Goods_type::with('level')->where('pid',0)->get()->toArray();

        return view("admin.goods.goods_sort",[
            'type' => $type,
        ]);
    }

    public function add(Request $req)
    {
        $type = new Goods_type;
        $type->fill($req->all());
        $type->save();
        return back();
    }
    public function update(Request $req)
    {
        $id = $req->id;
        $type = Goods_type::find($id);
        $type->fill($req->all());
        $type->save();
        return back();

    }

    public function delete(Request $req)
    {
        $id = $req->id;
        $type = Goods_type::with('level')->where('id',$id)->get()->toArray();
        // dd($type);
        $ids = [];
        foreach($type as $v)
        {
            $ids[] = $v['id'];
            foreach($v['level'] as $k)
            {
                $ids[] = $k['id'];
                foreach($k['level2'] as $d)
                {
                    $ids[] = $d['id'];
                }
            } 
        }
        Goods_type::whereIn('id',$ids)->delete();

        return redirect()->route('admin_goods_typelist');
    }
}
