<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'Admin','middleware'=>'auth'], function () {
    Route::get('/', 'GoodsController@index'); //后台首页
    Route::get('/admin/info/index','AdminController@admininfo');//管理员资料

    Route::get('/user','UserController@index');//用户管理界面
    Route::any('/user/edit','UserController@edit');//用户管理界面
    Route::get('/user/getuser','UserController@getUser');//ajax用户获取

    Route::get('/goods','GoodsController@index');//商品管理界面
    Route::any('/goods/edit','GoodsController@edit');//商品编辑界面

	Route::get('/putin','PutinController@index');//入库
    Route::any('/putin/edit','PutinController@edit');//入库编辑界面

	Route::get('/putout','PutoutController@index');//出库
    Route::any('/putout/edit','PutoutController@edit');//出库编辑界面

    Route::get('/static','StaticController@index');//统计销量
    Route::get('/static/profit','StaticController@profit');//统计利润

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
