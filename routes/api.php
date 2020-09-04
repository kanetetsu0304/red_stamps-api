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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // ログインしているユーザのみアクセスOKのルート
    Route::post('/redstamps', 'RedStampController@store');
    Route::get('/redstamps', 'RedStampController@index');
    Route::get('/redstampsAsc', 'RedStampController@indexAsc');
    Route::get('/redstamps/{id}', 'RedStampController@show');
    Route::put('/redstamps/{id}', 'RedStampController@update');
    Route::delete('/redstamps/{id}', 'RedStampController@destroy');

    Route::post('/users/follow', 'FollowController@store');
    Route::delete('/users/unfollow/{id}', 'FollowController@destroy');
    Route::get('/users/followings/{id}/', 'FollowController@followings');
    Route::get('/users/followers/{id}/', 'FollowController@followers');

    Route::get('/sanctuaries', 'SanctuaryController@index');

    Route::get('/users', 'UsersController@index');
    Route::get('/usersAsc', 'UsersController@indexAsc');
    Route::get('/users/{id}', 'UsersController@show');
    Route::get('/usersRedstamps/{id}', 'RedStampController@usersIndex');
    Route::get('/usersRedstamps/{userId}/{id}', 'RedStampController@usersShow');
});

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout');
