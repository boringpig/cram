<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PageController@getIndex']);

//Authentication Routes
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
//Registration Routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//Password Reset Routes
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@postReset');
// Social Login Routes
Route::get('auth/social/login/{provider?}',['as' => 'auth.getSocialAuth', 'uses' => 'Auth\AuthController@getSocialAuth']);
Route::get('auth/social/login/callback/{provider?}',['as' => 'auth.getSocialAuthCallback', 'uses' => 'Auth\AuthController@getSocialAuthCallback']);

Route::group(['prefix'=>'user'], function(){
	Route::get('/edit', ['as' => 'user.profile', 'uses' => 'UserController@getEditUser']);
	Route::post('/edit/{id}', ['as' => 'edit.user.profile', 'uses' => 'UserController@postEditUser']);
	Route::get('/account/change_password', ['as' => 'user.password', 'uses' => 'UserController@getChangePassword']);
	Route::post('/account/change_password', ['as' => 'change.user.password', 'uses' => 'UserController@postChangePassword']);
});
