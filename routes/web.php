<?php

    // 前台首页
    Route::get('/','Home\IndexController@index')->name('home_index');
    
    Route::group(['prefix'=>'home','namespace'=>'Home'],function()
    {
        // 前台登录注册
        Route::get('/login','LoginController@login')->name('home_login');
        Route::post('/login','LoginController@dologin')->name('home_dologin');

        Route::get('/register','RegisterController@register')->name('home_register');
        Route::post('/register','RegisterController@doregister')->name('home_doregister');

        // 发送短信验证
        Route::get('/sendmobile','RegisterController@send_mobile')->name('sendmobile');


        Route::middleware(['home_login'])->group(function(){

            // 退出
            Route::get('/logout','LoginController@logout')->name('home_logout');
        

        }); 
    });

    Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
    {
        // 后台登录
        Route::get('/login','LoginController@login')->name('admin_login');
        Route::post('/login','LoginController@dologin')->name('admin_dologin');

        Route::middleware(['login'])->group(function(){
            // 后台首页
            Route::get('/index','IndexController@index')->name('admin_index');
            Route::get('/home','IndexController@home')->name('admin_home');
            // 退出
            Route::get('/logout','LoginController@logout')->name('admin_logout');
            // 文章管理
            Route::get('/artlist','ArticleController@list')->name('admin_artlist');
            Route::get('/artcreate','ArticleController@create')->name('admin_artcreate');
            Route::post('/artadd','ArticleController@add')->name('admin_artadd');
            Route::get('/artedit/{id}','ArticleController@edit')->name('admin_artedit');
            Route::get('/artupdate','ArticleController@update')->name('admin_artupdate');
            Route::get('/artdelete','ArticleController@delete')->name('admin_artdelete');

            // 文章分类管理
            Route::get('/artsort','Article_cateController@sort')->name('admin_artsort');
            Route::post('/artsort_add','Article_cateController@add')->name('admin_artsort_add');
            Route::get('/artsort_edit/{id}','Article_cateController@edit')->name('admin_artsort_edit');
            Route::post('/artsort_update/{id}','Article_cateController@update')->name('admin_artsort_update');
            Route::get('/artsort_delete','Article_cateController@delete')->name('admin_artsort_delete');

            // 管理员管理
            Route::get('/admin_role','AdminController@list')->name('admin_adminlist');
            Route::post('/admin_add','AdminController@add')->name('admin_adminadd');
            Route::get('/admin_edit','AdminController@edit')->name('admin_adminedit');
            Route::get('/admin_update','AdminController@update')->name('admin_adminupdate');
            // Route::get('/admin_privilege','AdminController@')->name('admin_privilege');
            // Route::get('/admin_info','AdminController@bbb')->name('admin_admininfo');            

            // 会员管理

            // 商品管理
        });    
    });
    


