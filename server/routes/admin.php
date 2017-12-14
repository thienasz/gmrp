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

//Route::middleware('jwt.auth')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['cors'])->group(function (){
        //Check Admin Role
    Route::middleware(['jwt.auth', 'api-admin'])->group(function (){
        Route::post('logout','LoginController@logout');

        //Product
//            Route::post('product', 'ProductController@store');
//            Route::post('product/{productID}','ProductController@update');
//            Route::delete('product/{productID}','ProductController@delete');

        Route::get('/user', 'UserController@index');

        //Game
        Route::get('game', 'GameController@index'); //create
        Route::post('game', 'GameController@store'); //create
        Route::post('game/{gameID}', 'GameController@update'); //update
        Route::delete('game/{gameID}', 'GameController@delete'); //delete
    });


    //Register/Login
//    Route::post('register','RegisterController@register');
    Route::post('login','LoginController@adminLogin');

//Reset Password
    //Check mail and send mail
//    Route::post('forgot-password', 'ForgotPasswordController@checkMail');
//
//    //Response user email to reset
//    Route::get('forgot-password/{token}','ForgotPasswordController@getUserEmail');
//
//    //Reset password then renew password reset token
//    Route::put('forgot-password','ForgotPasswordController@resetPassword');
//
////Game
//    Route::get('post','GameController@index');
//    Route::get('post/{postID}','GameController@show');
});


