<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article_cate;
use App\Models\Article;

class ArticleController extends Controller
{
    //  根据分类显示文章列表
    public function list()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            if($id == 0)
            {
                $list = Article::with('cate')->get();
            }
            else
            {
                $list = Article::where('cateid',$id)->with('cate')->get();
            }
        }
        else
        {
            $list = Article::with('cate')->get();

        }
        $num = count(Article::with('cate')->get());
        $cates = Article_cate::get()->toArray();

        return view("admin.article.article_list",[
            'list' => $list,
            'num' => $num,
            'cates'=>$cates,
        ]);
    }
    // 显示添加文章页面
    public function create()
    {
        $cates = Article_cate::get()->toArray();

        return view("admin.article.article_add",[
            'cates' => $cates,
        ]);        
    }
    public function add(Request $req)
    {
        $article = Article::create($req->all());
        
        return redirect()->route('admin_artlist');
    }

    public function edit($id)
    {
        $cates = Article_cate::get()->toArray();
        $message = Article::find($id);
        return view("admin.article.article_edit",[
            'cates' => $cates,
            'message' => $message,
        ]);
    }
    public function update(Request $req,$id)
    {
        $article = Article::find($id);
        $article->fill($req->all());
        $article->save();

        return redirect()->route('admin_artlist');
    }
    public function delete()
    {
        $id = $_GET['id'];
        Article::destroy($id);

    }
}
