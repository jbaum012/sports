<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubmitPick;
use App\Http\Controllers\Api\UnpickedBets;

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
    Route::post('bets/{bet}/pick', SubmitPick::class)->name('submit-pick');
    Route::get('bets/unpicked', UnpickedBets::class)->name('unpicked-bets');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
