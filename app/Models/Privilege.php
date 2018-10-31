<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    public $timestamps = false;

    protected $table = 'privilege';
    // 设置白名单
    protected $fillable = ['pri_name','url_path','parent_id'];
}
