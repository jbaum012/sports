<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\SportsBetRepository;
use App\Http\Controllers\SportsGameController;
use App\Http\Controllers\SportsGameScoresController;
use App\Http\Controllers\SportsTeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return Redirect::route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $temp = new SportsBetRepository();
        $bets = $temp->getUnplacedBets(Auth::user()->id);
        $groupedByWeek = $bets->groupBy('game_group_id');
        return Inertia::render('Dashboard', [
            'bets' => $groupedByWeek
        ]);
    })->name('dashboard');
    Route::apiResource('teams', SportsTeamController::class);
    Route::get('/games/create', [SportsGameController::class, 'create'])->name('games.create');
    Route::apiResource('games', SportsGameController::class);
    Route::put('games/{game}/scores', [SportsGameScoresController::class, 'update'])->name('scores.update');
    Route::delete('games/{game}/scores', [SportsGameScoresController::class, 'destroy'])->name('scores.destroy');
});
