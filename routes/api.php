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
Route::group(['prefix' => 'user'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');
});

Route::middleware('auth:api')->group(function () {


    //user find and update routes
    Route::group(['prefix' => 'user'], function () {
        Route::get('info', 'Api\UserController@show');
        Route::put('update', 'Api\UserController@update');
    });


    //campaign routes
    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', 'Api\CampaignController@index');
        Route::post('/add-campaign', 'Api\CampaignController@addCampaignCode');
    });


});
