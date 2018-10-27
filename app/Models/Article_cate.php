<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article_cate extends Model
{
    public $timestamps = false;

    protected $table = 'article_cate';
    // 设置白名单
    protected $fillable = ['catename','descrip','is_enable'];
}
