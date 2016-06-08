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

Route::group(['prefix'=>'admin', 'middleware' => ['auth','admin']], function() {
    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::resource('lesson', 'LessonController');
    Route::resource('word', 'WordController');
    Route::get('category-lesson', ['as' => 'user.getCategoryLesson', 'uses' => 'WordController@getLessons']);
});

Route::group([ 'middleware' => ['auth']], function() {

    Route::resource('category', 'CategoryController', ['only'  => [
        'index',
        'show'
    ]]);

    Route::resource('wordAnswer', 'WordAnswerController', ['only'  => [
        'update',
    ]]);

    Route::resource('lesson', 'LessonController', ['only'  => [
        'index',
    ]]);

    Route::resource('word', 'WordController', ['only'  => [
        'index',
    ]]);

    Route::resource('user', 'UserController', ['only'  => [
        'index',
    ]]);
    
    Route::get('learning-lesson-{id}', ['as' => 'lesson.startLearning', 'uses' => 'LessonController@startLearning']);
    Route::get('user-info', ['as' => 'user.info', 'uses' => 'HomeController@getInfo']);
    Route::get('user-profile', ['as' => 'user.getUpdateProfile', 'uses' => 'UserController@getUpdateProfile']);
    Route::post('user-profile', ['as' => 'user.postUpdateProfile', 'uses' => 'UserController@postUpdateProfile']);
    Route::get('change-password', ['as' => 'user.getChangePassword', 'uses' => 'UserController@getChangePassword']);
    Route::post('change-password', ['as' => 'user.postChangePassword', 'uses' => 'UserController@postChangePassword']);
});
