<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::get('/teams', 'TeamController@index');

    Route::get('/current-week', 'CurrentWeekController@show');
    Route::get('/pick-week', 'PickWeekController@show');
    Route::get('/week/{week_id}/games', 'WeeklyGamesController@show');

    Route::get('/bet/{game_id}', 'BetController@show');
    Route::post('/bet', 'BetController@store');
    Route::put('/bet/{bet}', 'BetController@update');

    Route::post('/bet/{bet}/double-down', 'DoubleDownController@store');
    Route::delete('/bet/{bet}/double-down', 'DoubleDownController@destroy');

    Route::get('/games', 'GameController@index');
    Route::get('/game/{game}', 'GameController@show');
    Route::post('/game', 'GameController@store');
    Route::put('/game/{game}', 'GameController@update');
    Route::delete('/game/{game}', 'GameController@destroy');
});
