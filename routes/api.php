<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth1:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['namespace' => 'Api'], function () {
   Route::group(['prefix' => '/room'], function() {
       Route::post('create','RoomApiController@create');
       Route::post('join','RoomApiController@create');
       Route::group(['middleware' => 'auth1:room'], function() {

       });
    });
   Route::post('/search_by_name','SearchApiController@searchByName');
   Route::post('/song/add','SongApiController@create');
   Route::post('/song/delete','SongApiController@delete');
   Route::post('/song/add-first','SongApiController@addFirst');
   Route::post('/song/add-playing','SongApiController@addPlaying');
});
