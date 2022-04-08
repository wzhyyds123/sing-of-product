<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

/**
 * 用户登录操作
 */
Route::prefix('users')->group(function (){
Route::post('login','Product\UsersController@login');  //用户登录
Route::post('registered','Product\UsersController@registered');  //用户注册
Route::post('again','Product\UsersController@again');  //修改用户密码
});//--wzh
/**
 * 超管登录操作
 */
Route::prefix('admin')->group(function (){
    Route::post('login','Product\AdminController@login');  //用户登录
    Route::post('registered','Product\AdminController@registered');  //用户注册
    Route::post('again','Product\AdminController@again');  //重置用户密码
});//--wzh
/**
 * 表单管理操作
 */
Route::middleware('jwt.role:user', 'jwt.auth')->prefix('product')->group(function (){
    Route::post('add','Product\ProductController@addproduct');   //记录表添加
    Route::post('delete','Product\ProductController@delete');    //记录表删除
    Route::post('change','Product\ProductController@change');    //记录表修改
    Route::post('find','Product\ProductController@find');        //记录表查询
});//--wzh

/*
Route::prefix('users')->group(function (){
    Route::post('login','user\UserController@login');  //登录11
    Route::post('registered','user\UserController@registered');  //注册11
    Route::post('again','user\UserController@again');  // 修改密码11
    Route::post('modify','User\UserController@modify');//忘记密码-修改密码
});
*/

Route::prefix('manager')->group(function (){
    Route::post('add','user\UserController@registered');  //注册11
    Route::post('modify','manager\ManagerController@modify');  //修改11
    Route::post('delete','manager\ManagerController@delete');  //删除11
    Route::get('showall','manager\ManagerController@showall');  //查看所有11
    Route::post('show','manager\ManagerController@show');  //根据名称查看11
    Route::post('showxx','manager\ManagerController@showxx');  //详情11



});

