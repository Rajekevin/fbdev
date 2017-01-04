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

/**
 * Routes used in front-end web pages
 */
Route::get('/', [
    'as'        => 'root',
    'uses'      => 'Frontend\HomeController@index'
]);
Route::get('/participate', [
    'as'        => 'participate',
    'uses'      => 'Frontend\ParticipateController@index'
])->middleware('askPermission');

/**
 * Routes used for AJAX actions
 */
Route::post('/add/like', [
    'uses'      => 'Frontend\UserController@addLike'
])->middleware('isAjax');
Route::post('/add/vote', [
    'uses'      => 'Frontend\RateController@addVote'
])->middleware('isAjax');
Route::post('/add/share', [
    'uses'      => 'Frontend\SocialController@sharePicture'
])->middleware('isAjax');

Route::get('/contest/likest', [
    'uses'      => 'Frontend\ContestController@getPicturesByLike'
])->middleware('isAjax');
Route::get('/contest/newest', [
    'uses'      => 'Frontend\ContestController@getPicturesByNewest'
])->middleware('isAjax');
Route::get('/contest/alphabetical', [
    'uses'      => 'Frontend\ContestController@getPicturesByAlphabetical'
])->middleware('isAjax');

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

    Route::resource('contests', 'Admin\ContestController');
});