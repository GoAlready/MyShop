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
        $privilege = Privilege::get()->toArray();

        return view("admin.privilege.pri_add",[
            'pri' => $privilege,
        ]);
    }
    public function add()
    {
        
    }

    public function edit()
    {
        return view("admin.privilege.pri_edit");
    }
}
