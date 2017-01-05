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
 *  --> [POST] = participate/valid-your-picture
 *
 */
Route::group(['prefix' => 'participate'], function () {
    Route::get('choose-your-picture', [
        'as'        => 'participate',
        'uses'      => 'Frontend\ParticipateController@index'
    ]);
    Route::get('valid-your-picture', [
        'as'        => 'participate_valid_picture',
        'uses'      => 'Frontend\ParticipateController@valid'
    ]);
    Route::post('valid-your-picture', [
        'as'        => 'participate_valid_picture',
        'uses'      => 'Frontend\ParticipateController@valid'
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
    Route::post('/add/vote', [
        'uses'      => 'Frontend\RateController@addVote'
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
     *  --> Get albums and photos as JSON
     *  --> Get photos from album id as JSON
     */
    Route::get('/albums/all', [
        'uses'      => 'Frontend\XhrController@getAlbums'
    ]);
    Route::get('/album/{id}/photos', [
        'uses'      => 'Frontend\XhrController@getPhotoFromAlbumId'
    ]);
});