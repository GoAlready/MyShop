<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Privilege;

class PrivilegeController extends Controller
{
    public function list()
    {
        $privilege = Privilege::get()->toArray();

        foreach($privilege as $k=>$v)
        {
            if($v['parent_id']==0) continue;
            $privilege[$k]['parent'] = Privilege::select('pri_name')->where('id',$v['parent_id'])->first()->toArray();
        }

        return view("admin.privilege.pri_list",[
            'privilege' => $privilege,
        ]);

    }
    public function create()
    {
        $privilege = Privilege::with('level')->where('parent_id',0)->get()->toArray();
        return view("admin.privilege.pri_add",[
            'pri' => $privilege,
        ]);
    }
    public function add(Request $req)
    {
        if($req->pri_name && $req->url_path)
        {
            $pri = Privilege::create($req->all());
        }
        else
        {
            return back();
        }
        return redirect()->route('admin_prilist');

    }

    public function edit()
    {
        $id = $_GET['id'];
        $privilege = Privilege::with('level')->where('parent_id',0)->get()->toArray();
        $message = Privilege::find($id)->toArray();

        return view("admin.privilege.pri_edit",[
            'pri' => $privilege,
            'message' => $message,
        ]);
    }
    public function update(Request $req)
    {
        $id = $_GET['id'];
        $pri = Privilege::find($id);
        $pri->fill($req->all());
        $pri->save();
        return redirect()->route('admin_prilist');

    }

    public function delete()
    {
        $id = $_GET['id'];
        Privilege::destroy($id);
        
    }
}
