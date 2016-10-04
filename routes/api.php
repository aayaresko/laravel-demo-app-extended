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

Route::group(['middleware' => ['auth:api', 'cors']], function () {
    Route::get('/user', function (Request $request) {
        $account = $request->user();
        $account->profile;
        return $account;
    });
    Route::group(['namespace' => 'REST'], function () {
        Route::resource('tasks', 'TaskController');
    });
});