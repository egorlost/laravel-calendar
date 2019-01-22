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

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/event_activity/data', 'CalendarController@data')->name('calendar.data');
    Route::apiResource('/event_activity', 'CalendarController');

    Route::get('/users/current', 'AuthController@user');
    Route::delete('/users/current', 'AuthController@logout');
});
