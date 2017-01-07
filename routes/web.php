<?php

/*****************************************\
*** Routes used in front-end web pages  ***
\*****************************************/
Route::get('/', [
    'as'        => 'root',
    'uses'      => 'Frontend\HomeController@index'
]);
Route::get('/facebook/callback', [
    'as'        => 'login',
    'uses'      => 'Frontend\UserController@facebookCallback'
]);
/**
 *  Participate URLS
 *  --> [GET] = participate/choose-your-picture
 *  --> [GET] = participate/valid-your-picture
 *  --> [GET] = participate/success
 *
 *  --> [POST] = participate/valid-your-picture
 *
 */
Route::group(['middleware' => 'canForward', 'prefix' => 'participate'], function () {
    Route::get('choose-your-picture', [
        'as'        => 'participate',
        'uses'      => 'Frontend\ParticipateController@choose'
    ]);
    Route::get('valid-your-picture', [
        'as'        => 'participate_valid_picture',
        'uses'      => 'Frontend\ParticipateController@valid'
    ]);
    Route::post('success', [
        'as'        => 'participate_success',
        'uses'      => 'Frontend\ParticipateController@success'
    ]);
    Route::post('valid-your-picture', [
        'as'        => 'participate_valid_picture',
        'uses'      => 'Frontend\ParticipateController@nextStep'
    ]);
});

/*****************************************\
****** Routes used for AJAX actions  ******
\*****************************************/
Route::group(['middleware' => 'isAjax', 'prefix' => 'xhr'], function () {
    /**
     *  USER ACTIONS
     *  --> Vote / Like
     *  --> Share picture
     */
    Route::post('/add/like', [
        'uses'      => 'Frontend\RateController@addLike'
    ]);
    Route::post('/add/share', [
        'uses'      => 'Frontend\SocialController@sharePicture'
    ]);
    /**
     *  USER SORT FONCTIONNALITY
     *  --> Sort by more like
     *  --> Sort by newest
     *  --> Sort by alphabetical order
     */
    Route::get('/contest/likest', [
        'uses'      => 'Frontend\ContestController@getPicturesByLike'
    ]);
    Route::get('/contest/newest', [
        'uses'      => 'Frontend\ContestController@getPicturesByNewest'
    ]);
    Route::get('/contest/alphabetical', [
        'uses'      => 'Frontend\ContestController@getPicturesByAlphabetical'
    ]);
    /**
     *  AJAX REQUEST USED FOR FACEBOOK DATA
     *  --> [GET] = xhr/albums/all { albums and photos as JSON }
     *  --> [GET] = xhr/album/{id}/photos { Get photos from album id as JSON }
     */
    Route::get('/albums/all', [
        'uses'      => 'Frontend\XhrController@getAlbums'
    ]);
    Route::get('/album/{id}/photos', [
        'uses'      => 'Frontend\XhrController@getPhotoFromAlbumId'
    ]);
});