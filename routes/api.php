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
| ------------------------------------------------- -------------------------
| APIルート
| ------------------------------------------------- -------------------------
|
| ここにあなたのアプリケーション用のAPIルートを登録することができます。 これら
| ルートはRouteServiceProviderによってグループ内でロードされます。
| "api"ミドルウェアグループが割り当てられています。 あなたのAPIを構築してください。
|
*/

Route::group(['prefix' => '/auth', ['middleware' => 'throttle:20,5']], function (){
   Route::post('/register', 'Auth\RegisterController@register');
   Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth:api'], function (){
//Route::group(['middleware' => 'jwt.auth'], function (){
    Route::get('/me', 'MeController@index');
    Route::get('/auth/logout', 'MeController@logout');
});
