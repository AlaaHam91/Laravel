<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace'=>"API"], function () {
    //below routes dont need auth

    Route::group(['prefix' => 'auth'], function () {
        //create new user
        Route::post('register',"AuthController@register");
        //login
        Route::post("login","AuthController@login");

        //refresh JWT token
        Route::get("refresh","AuthController@refresh");




    });
    //below routes need auth

    Route::group(['middleware' => 'auth:api',"prefix"=>"auth"], function () {
        //logout user
        Route::post('logout', "AuthController@logout");
        //get user info
        Route::get('user', "AuthController@user");

        Route::get('allNotifications', "AuthController@allNotifications");
        Route::post("login","AuthController@login");


    });

    Route::apiResource("channels","ChannelController");
    Route::apiResource("discussions","DiscussionController");
    Route::apiResource("replies","ReplayController");

});
