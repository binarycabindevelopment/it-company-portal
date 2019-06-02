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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//->middleware(['auth'])
//TODO - in-app permissions / tokens
Route::namespace('API')->prefix('/')->group(function(){
    Route::namespace('Tickets')->prefix('/ticket')->group(function(){
        Route::get('/', 'TicketController@index');
    });
    Route::namespace('Calendars')->prefix('/calendar')->group(function(){
        Route::namespace('Schedules')->prefix('/schedule')->group(function(){
            Route::prefix('/{scheduleId}')->group(function(){
                Route::get('/', 'ScheduleController@show');
            });
        });
    });
});