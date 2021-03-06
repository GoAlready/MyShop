<?php

    // 前台首页
    Route::get('/','Home\IndexController@index')->name('home_index');
    
    Route::group(['prefix'=>'home','namespace'=>'Home'],function()
    {
        // 登录注册
        {
            // 前台登录注册页面
            Route::get('/login','LoginController@login')->name('home_login');
            Route::get('/register','RegisterController@register')->name('home_register');

            // 前台登录注册数据
            Route::post('/login','LoginController@dologin')->name('home_dologin');
            Route::post('/register','RegisterController@doregister')->name('home_doregister');
        }

        // 发送短信验证
        Route::get('/sendmobile','RegisterController@send_mobile')->name('sendmobile');

        Route::middleware(['home_login'])->group(function(){
            // 退出登录
            Route::get('/logout','LoginController@logout')->name('home_logout');
            // 商品详情页‘
            Route::get('/goods','GoodsController@good')->name('home_good');
            // 商品搜索页
            Route::get('/goodsearch',"GoodsController@search")->name("admin_goodsearch");
        }); 
    });

    // 后台管理
    Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
    {
        // 后台登录
        Route::get('/login','LoginController@login')->name('admin_login');
        Route::post('/login','LoginController@dologin')->name('admin_dologin');

        Route::middleware(['login'])->group(function(){
            // 后台首页
            Route::get('/','IndexController@index')->name('admin_index');
            Route::get('/home','IndexController@home')->name('admin_home');
            // 退出
            Route::get('/logout','LoginController@logout')->name('admin_logout');

            // 文章管理
            {
                Route::get('/artlist','ArticleController@list')->name('admin_artlist');
                Route::get('/artcreate','ArticleController@create')->name('admin_artcreate');
                Route::post('/artadd','ArticleController@add')->name('admin_artadd');
                Route::get('/artedit','ArticleController@edit')->name('admin_artedit');
                Route::get('/artupdate','ArticleController@update')->name('admin_artupdate');
                Route::get('/artdelete','ArticleController@delete')->name('admin_artdelete');
            }

            // 文章分类管理
            {
                Route::get('/artsort','Article_cateController@sort')->name('admin_artsort');
                Route::post('/artsort_add','Article_cateController@add')->name('admin_artsort_add');
                Route::get('/artsort_edit','Article_cateController@edit')->name('admin_artsort_edit');
                Route::post('/artsort_update','Article_cateController@update')->name('admin_artsort_update');
                Route::get('/artsort_delete','Article_cateController@delete')->name('admin_artsort_delete');
            }

            // 管理员管理
            {   
                Route::get('/admin_list','AdminController@list')->name('admin_adminlist');
                Route::post('/admin_add','AdminController@add')->name('admin_adminadd');
                Route::get('/admin_edit','AdminController@edit')->name('admin_adminedit');
                Route::post('/admin_update','AdminController@update')->name('admin_adminupdate');
                Route::get('/admin_delete','AdminController@delete')->name('admin_admindelete');
            }

            // 角色管理
            {
                Route::post('/role_update','RoleController@update')->name('admin_roleupdate'); 
                Route::get('/role_delete','RoleController@delete')->name('admin_roledelete');
                Route::get('/role_list','RoleController@list')->name('admin_rolelist');
                Route::get('/role_create','RoleController@create')->name('admin_rolecreate'); 
                Route::post('/role_add','RoleController@add')->name('admin_roleadd'); 
                Route::get('/role_edit','RoleController@edit')->name('admin_roleedit'); 
            }

            // 权限管理
            {
                Route::get('/pri_list','PrivilegeController@list')->name('admin_prilist');
                Route::get('/pri_create','PrivilegeController@create')->name('admin_pricreate'); 
                Route::post('/pri_add','PrivilegeController@add')->name('admin_priadd'); 
                Route::get('/pri_edit','PrivilegeController@edit')->name('admin_priedit'); 
                Route::post('/pri_update','PrivilegeController@update')->name('admin_priupdate'); 
                Route::get('/pri_delete','PrivilegeController@delete')->name('admin_pridelete');
            }

            // 会员管理
            {
                // 页面
                {
                    // 会员列表
                    Route::get("/member/list","UserController@getMemberList")->name("admin_member_list");
                    // 会员等级管理
                    Route::get("/member/level/management","UserController@getMemberLevelManagement")->name("admin_member_level");
                    // 会员记录管理
                    Route::get("/member/integral","UserController@getMemberIntegral")->name("admin_member_integral");
                }
                // 数据
                {   
                    // 会员列表
                    {
                        // 会员激活/禁用
                        Route::get('/member/disableorenable',"UserController@memberDisableOrEnable");
                        // 会员信息获取
                        Route::get('/member/info',"UserController@getMemberInfo");
                        // 会员信息修改
                        Route::post("/member/info/update","UserController@updateMemberInfo");
                        // 删除会员
                        Route::get('/member/delete', 'UserController@deleteMember');
                        // 新增会员
                        Route::post('/member/insert', 'UserController@memberInsert');

                    }
                }
            }
            // 商品管理
            {
                // 商品分类
                {
                    Route::get('/goods_type',"Goods_typeController@list")->name("admin_goods_typelist");
                    Route::post('/goods_typeadd',"Goods_typeController@add")->name("admin_goods_typeadd");
                    Route::post('/goods_typeupdate',"Goods_typeController@update")->name("admin_goods_typeupdate");
                    Route::post('/goods_typedelete',"Goods_typeController@delete")->name("admin_goods_typedelete");
                }
                // 品牌模块
                {
                    Route::get('/goods_brand',"Goods_brandController@list")->name("admin_goods_brandlist");
                    Route::get('/goods_brandcreate',"Goods_brandController@create")->name("admin_goods_brandcreate");
                    Route::post('/goods_brandadd',"Goods_brandController@add")->name("admin_goods_brandadd");
                    Route::get('/goods_brandedit',"Goods_brandController@edit")->name("admin_goods_brandedit");
                    Route::post('/goods_brandupdate',"Goods_brandController@update")->name("admin_goods_brandupdate");
                    Route::get('/goods_branddelete',"Goods_brandController@delete")->name("admin_goods_branddelete");
                }
                // 商品
                {
                    Route::get('/goods',"GoodsController@list")->name("admin_goodslist");
                    Route::get('/goodscreate',"GoodsController@create")->name("admin_goodscreate");
                    Route::post('/goodsadd',"GoodsController@add")->name("admin_goodsadd");
                    // ajax获取商品分类
                    Route::get('/goods_ajax',"GoodsController@ajax_getcate");
                    // ajax获取品牌分类
                    Route::get('/goods_ajaxbrand',"GoodsController@ajax_getbrand");                    
                }
            }
            
        });    
    });
    


