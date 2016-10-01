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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// ['cors', 'auth:api']
Route::group(['namespace' => 'REST', 'middleware' => 'cors'], function () {
    Route::resource('tasks', 'TaskController');
    Route::options('tasks', function (Request $request) {
        $headers = [
            'Access-Control-Allow-Headers' => 'access-control-request-methods, access-control-request-origin, content-type',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ];
        return response('OK', 200, $headers);
    });
});