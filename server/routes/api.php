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
    Route::middleware(['jwt.auth', 'api-sdk'])->group(function(){
        Route::post('logout','LoginController@logout');

        Route::post('new-register','RegisterController@addNewRegister');

        Route::post('pay','UserController@pay');


        //Check Admin Role
        Route::middleware(['role-admin'])->group(function (){
            //Product
            Route::post('product', 'ProductController@store');
            Route::post('product/{productID}','ProductController@update');
            Route::delete('product/{productID}','ProductController@delete');

            Route::get('/user', 'UserController@index');

            //Post
            Route::post('post', 'PostController@store'); //create
            Route::post('post/{postID}', 'PostController@update'); //update
            Route::delete('post/{postID}', 'PostController@delete'); //delete
        });

    });


    //Register/Login
    Route::post('register','RegisterController@register');
    Route::post('login','LoginController@login');
    Route::post('fblogin','LoginController@fbLogin');

//Reset Password
    //Check mail and send mail
    Route::post('forgot-password', 'ForgotPasswordController@checkMail');

    //Response user email to reset
    Route::get('forgot-password/{token}','ForgotPasswordController@getUserEmail');

    //Reset password then renew password reset token
    Route::put('forgot-password','ForgotPasswordController@resetPassword');

//Post
    Route::get('post','PostController@index');
    Route::get('post/{postID}','PostController@show');
});


