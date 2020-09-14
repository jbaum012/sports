<?php

namespace App\Http\Controllers;

use App\Season;
use Illuminate\Http\Request;

class PickWeekController extends Controller
{
    public function show()
    {
        return Season::find(env('BETTING_SEASON', 1))->pickWeek();
    }
}
