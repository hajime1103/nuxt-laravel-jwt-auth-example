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

//メール送信テスト用
Route::get('/mail/send', 'TestMailController@send');

Route::group(['prefix' => '/auth', ['middleware' => 'throttle:20,5']], function (){
   Route::post('/register', 'Auth\RegisterController@register');
   Route::post('/login', 'Auth\LoginController@login');
   Route::post("/password/email", "Auth\ForgotPasswordController@sendResetLinkEmail");
   Route::post("/password/reset/{token}", "Auth\ResetPasswordController@reset");
   Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
   Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => 'auth:api'], function (){
//Route::group(['middleware' => 'jwt.auth'], function (){
    Route::get('/me', 'MeController@index');
    Route::get('/auth/logout', 'MeController@logout');
});
