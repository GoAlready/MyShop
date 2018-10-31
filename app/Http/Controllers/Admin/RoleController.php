<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function list()
    {

        return view("admin.role.role_list");

    }
    public function create()
    {
        return view("admin.role.role_add");
    }

    public function edit()
    {
        return view("admin.role.role_edit");
    }
}


