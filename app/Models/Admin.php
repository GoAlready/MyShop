<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    public $timestamps = false;

    protected $table = 'admin';
    // 设置白名单
    protected $fillable = ['adminname','password','sex','phone','email','qq'];
    
    public function role()
    {
        return $this->belongsToMany('App\Models\Role','admin_role','admin_id','role_id');
    }
}
