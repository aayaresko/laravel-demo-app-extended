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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

// ['cors', 'auth:api']

Route::group(['namespace' => 'REST', 'middleware' => 'cors'], function () {
    Route::get('account', 'AccountController@identify');
    Route::resource('tasks', 'TaskController');
    Route::options('{any}', function() {
        return response('', 200);
    })->where('{any}', '[a-zA-Z0-9_\-\/]+');
});