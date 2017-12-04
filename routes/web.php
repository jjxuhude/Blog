<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//首页
Route::get('/', function () {
    return view('frontend/welcome');
});


//前台
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Auth::routes();
});

//后台
Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::get('home', 'HomeController@index')->name('admin.home');
    Route::get('/', function () {
        return view('backend.auth.login');
    });
    Route::get('register',function (){
        return view('backend.auth.register');
    });
    //Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    //Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');

    Route::post('register', 'Auth\RegisterController@register');
});
