<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $timestamps = false;

    protected $table = 'article';
    // 设置白名单
    protected $fillable = ['title','descript','content','cateid'];

    // 关联模型
    public function cate()
    {
        return $this->belongsTo('App\Models\Article_cate','cateid');
    }
    
}
