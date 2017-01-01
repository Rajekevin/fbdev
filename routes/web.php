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






// @TODO : Ajouter un middleware de sécurité pour chaques routes AJAX
/**
 * Routes used for AJAX actions
 */
Route::get('/add/like', [
    'uses'      => 'Frontend\UserController@addLike'
]);
Route::get('/add/picture', [
    'uses'      => 'Frontend\UserController@addPicture'
]);