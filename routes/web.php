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
        return '<a href="' . Facebook::getLoginUrl() . '">Login</a>';
    } else {
        if (!checkScope()) {
            return '<a href="' . Facebook::getReRequestUrl(getDefaultScope()) . '">Rerequest permissions</a>';
        } else {
            if (Session::get('isAdmin'))
                $msg = 'welcome admin';
            else
                $msg = 'welcome';
            return $msg . '<br><a href="' . url('/logout') . '">Logout</a>';
        }
    }
});

Route::get('/callback', 'SocialAuthController@callback');
Route::get('/logout', 'SocialAuthController@logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth', 'admin'], function () {
    Route::get('/', 'Admin\DefaultController@index')->name('dashboard');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', 'Admin\UserController@index')->name('index');
        Route::put('/activate/{id}', 'Admin\UserController@toggleActive')->name('activate');
    });
});