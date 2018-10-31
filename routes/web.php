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
                Route::get('/artedit/{id}','ArticleController@edit')->name('admin_artedit');
                Route::get('/artupdate','ArticleController@update')->name('admin_artupdate');
                Route::get('/artdelete','ArticleController@delete')->name('admin_artdelete');
            }

            // 文章分类管理
            {
                Route::get('/artsort','Article_cateController@sort')->name('admin_artsort');
                Route::post('/artsort_add','Article_cateController@add')->name('admin_artsort_add');
                Route::get('/artsort_edit/{id}','Article_cateController@edit')->name('admin_artsort_edit');
                Route::post('/artsort_update/{id}','Article_cateController@update')->name('admin_artsort_update');
                Route::get('/artsort_delete','Article_cateController@delete')->name('admin_artsort_delete');
            }

            // 管理员管理
            {   
                Route::get('/admin_list','AdminController@list')->name('admin_adminlist');
                Route::post('/admin_add','AdminController@add')->name('admin_adminadd');
                Route::get('/admin_edit/{id}','AdminController@edit')->name('admin_adminedit');
                Route::post('/admin_update/{id}','AdminController@update')->name('admin_adminupdate');
                Route::get('/admin_delete','AdminController@delete')->name('admin_admindelete');
            }

            // 角色管理
            {
                Route::get('/role_list','RoleController@list')->name('admin_rolelist');
                Route::get('/role_create','RoleController@create')->name('admin_rolecreate'); 
                Route::post('/role_add','RoleController@add')->name('admin_roleadd'); 
                Route::get('/role_edit','RoleController@edit')->name('admin_roleedit'); 
                Route::post('/role_update','RoleController@create')->name('admin_roleupdate'); 
            }

            // 权限管理
            {
                Route::get('/pri_list','PrivilegeController@list')->name('admin_prilist');
                Route::get('/pri_create','PrivilegeController@create')->name('admin_pricreate'); 
                Route::post('/pri_add','PrivilegeController@add')->name('admin_priadd'); 
                Route::get('/pri_edit','PrivilegeController@edit')->name('admin_priedit'); 
                Route::post('/pri_update','PrivilegeController@create')->name('admin_priupdate'); 
            }

            // 会员管理
            {
                // 页面
                {
                    // 会员列表
                    Route::get("/member/list","UserController@getMemberList")->name("admin_member_list");
                    // 会员等级管理
                    // Route::get("/member/level/management","UserController@getMemberLevelManagement")->name("admin_member_list");
                    // 会员记录管理
                    // Route::get("/member/list","UserController@")->name("admin_member_list");
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
        });    
    });
    


