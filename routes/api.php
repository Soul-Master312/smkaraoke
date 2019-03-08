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

use Illuminate\Routing\Router;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/** @var Router $router */

$router->group(['prefix' => '/room', 'namespace' => 'Api'], function (Router $router) {
    $router->post('create','RoomApiController@create');
    $router->post('join','RoomApiController@create');
    $router->group(['middleware' => 'auth:room'], function() {

    });
});
