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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sample', 'Api\HomeController@index')->name('api.home');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['prefix' => 'v1', 'as' => 'api.v1.', 'namespace' => 'Api'], function() {
    Route::resource('checkins', 'CheckInController', ['only' => ['store', 'index']]);
    Route::resource('users', 'UserController', ['only' => ['show']]);
});
