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
]);
Route::get('/facebook/callback', [
    'as'        => 'login',
    'uses'      => 'Frontend\UserController@facebookCallback'
]);

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