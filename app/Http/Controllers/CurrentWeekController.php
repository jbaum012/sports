<?php

namespace App\Http\Controllers;

use App\Season;

class CurrentWeekController extends Controller
{
    public function show()
    {
        return Season::find(env('BETTING_SEASON', 1))->currentWeek();
    }
}
