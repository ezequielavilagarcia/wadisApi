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
Route::resource('containers.zones','Container\ContainerZoneController',['only' => ['store']]);
Route::resource('containertasks','ContainerTask\ContainerTaskController',[
	'only' => ['store'],
	'parameters' => ['containertasks' => 'container_task']
	]);
Route::resource('containers.containertasks','Container\ContainerContainerTaskController',['only' => ['index']]);

/* ESTADOS */
Route::resource('fullnesses','ContainerState\FullnessController',['only' => ['store']]);
Route::resource('locations','ContainerState\LocationController',['only' => ['store']]);
Route::resource('alerts','ContainerState\AlertController',['only' => ['store']]);
Route::resource('containers.containerstates','Container\ContainerContainerStateController',['only' => ['index']]);
/* ZONAS */
Route::resource('zones','Zone\ZoneController',['except' => ['create','edit']]);
Route::resource('zones.containers','Zone\ZoneContainerController',['only' => ['index']]);

/* Tareas */
Route::resource('tasktypes','TaskType\TaskTypeController',['only' => ['index','store']]);
Route::resource('tasks','Task\TaskController',['only' => ['index','store']]);

/* Usuario */
Route::resource('userprofiles','UserProfile\UserProfileController', ['only' => ['index','store']]);
Route::resource('userprofiles.tasks','UserProfile\UserProfileTaskController',[
	'only' => ['index'],
	'parameters' => ['userprofiles' =>'user_profile']
	]
	
	);
Route::resource('users','User\UserController',['except' => ['create','edit']]);
Route::resource('users.containertasks','User\UserContainerTaskController',['only' => ['index']]);
/* Planes*/

Route::resource('frecuencytypes','FrecuencyType\FrecuencyTypeController', ['only' => ['index']]);

Route::resource('plans','Plan\PlanController',['only' => ['index', 'show','store']]);


