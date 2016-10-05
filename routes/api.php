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

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/

Route::group(['middleware' => ['cors', 'auth:api']], function () {
    Route::get('/user', function (Request $request) {
        $account = $request->user();
        $account->profile;
        return response()->json($account);
    });
    Route::group(['namespace' => 'REST'], function () {
        Route::resource('tasks', 'TaskController');
    });
});