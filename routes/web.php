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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    if (!auth()->check()) {
        return '<a href="' . Facebook::getLoginUrl() . '">Login FB</a>';
    } else {
        if (Session::get('isAdmin'))
            return 'welcome admin';
        else
            return 'welcome';
    }
});

Route::get('/callback', 'SocialAuthController@callback');

Route::group(['prefix' => 'admin', "as" => "admin."], function () {
    Route::get('/', function () {
        return view('BO.index');
    })->name('dashboard')->middleware('admin');
});