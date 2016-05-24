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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@logout');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('user', 'UserController', [
        'only'  => [
            'index', 
            'show', 
            'edit', 
            'update',
        ],
    ]);
});