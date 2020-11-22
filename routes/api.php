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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//LineBot Hooks
Route::post('/linebot', 'API\LineBotController@hooks');

//User Auth API
Route::post('login', 'API\UserLoginController@login');
Route::post('logout', 'API\UserLoginController@logout');
Route::post('refresh', 'API\UserLoginController@refresh');
Route::post('me', 'API\UserLoginController@me');

//Post API
// Route::get('posts', 'API\PostController@index');
// Route::apiResource('posts', 'API\PostController');

