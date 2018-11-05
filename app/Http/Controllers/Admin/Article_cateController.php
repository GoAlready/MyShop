<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article_cate;

use App\Models\Article;


class Article_cateController extends Controller
{
    // 显示文章分类页面
    public function sort()
    {   
        // 取出所有的分类
        $cates = Article_cate::get();
        $num = count($cates);
        return view("admin.article.article_sort",[
            'cates' => $cates,
            'num' => $num,
        ]);        
    }
    // 添加分类
    public function add(Request $req)
    {
        if($req->catename || $req->descrip != '')
        {
            // 创建模型对象
            $artcate = Article_cate::create($req->all());
            $artcate->is_enable = $req->is_enable ? : 1;
            $artcate->save();
            return redirect()->route('admin_artsort');
        }
        else
        {
            return back();
        }
    }

    // 编辑分类
    public function edit($id)
    {
        $message = Article_cate::where('id',$id)->first();

        return view("admin.article.article_sort_edit",[
            'message' => $message,
        ]);
    }

    public function update(Request $req)
    {
        $id = $_GET['id'];
        $message = Article_cate::where('id',$id)->update(['catename'=>$req->catename,'is_enable'=>$req->is_enable,'descrip'=>$req->descrip]);
        
        return redirect()->route('admin_artsort');
    }
    public function delete()
    {
        $id = $_GET['id'];
        Article::where('cateid',$id)->delete();
        Article_cate::destroy($id);
        return redirect()->route('admin_artsort');
    }
}
