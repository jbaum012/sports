<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubmitPick;
use App\Http\Controllers\Api\UnpickedBets;
use App\Http\Controllers\Api\DoubleDownController;

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
    Route::get('users', function () {
        return User::all();
    });
    Route::put('bets/{bet}/pick', SubmitPick::class)->name('submit-pick');
    Route::post('bets/{bet}/double', [DoubleDownController::class, 'store'])->name('double-down');
    Route::delete('bets/{bet}/double', [DoubleDownController::class, 'destroy'])->name('double-down.destroy');
    Route::get('bets/unpicked', UnpickedBets::class)->name('unpicked-bets');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
