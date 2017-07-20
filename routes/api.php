<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::resource('containers','Container\ContainerController',['except' => ['create','edit']]);
/* ESTADOS */
Route::resource('fullnesses','ContainerState\FullnessController',['only' => ['store']]);
Route::resource('locations','ContainerState\LocationController',['only' => ['store']]);
Route::resource('alerts','ContainerState\AlertController',['only' => ['store']]);
Route::resource('containers.containerstates','Container\ContainerContainerStateController',['only' => ['index']]);

