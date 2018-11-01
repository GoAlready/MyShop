<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    public $timestamps = false;

    protected $table = 'privilege';
    // 设置白名单
    protected $fillable = ['pri_name','url_path','parent_id'];
    // 关联模型
    public function level2()
    {
        return $this->hasMany('App\Models\Privilege','parent_id','id');
    }
    public function level()
    {
        return $this->hasMany('App\Models\Privilege','parent_id','id')->with('level2');
    }


    public function role()
    {
        return $this->belongsToMany('App\Models\Role','role_privilege','pri_id','role_id');
    }
}
