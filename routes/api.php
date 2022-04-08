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

Route::prefix('users')->group(function (){

    Route::post('login','user\UserController@login');  //登录11
    Route::post('registered','user\UserController@registered');  //注册11
    Route::post('again','user\UserController@again');  // 修改密码11

    Route::post('modify','User\UserController@modify');//忘记密码-修改密码

});
Route::prefix('manager')->group(function (){
    Route::post('add','user\UserController@registered');  //注册11
    Route::post('modify','manager\ManagerController@modify');  //修改11
    Route::post('delete','manager\ManagerController@delete');  //删除11
    Route::get('showall','manager\ManagerController@showall');  //查看所有11
    Route::post('show','manager\ManagerController@show');  //根据名称查看11
    Route::post('showxx','manager\ManagerController@showxx');  //详情11







});
