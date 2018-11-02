<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $table = 'role';
    // 设置白名单
    protected $fillable = ['role_name','descript'];

    public function privilege()
    {
        return $this->belongsToMany('App\Models\Privilege','role_privilege','role_id','pri_id');
    }
}
