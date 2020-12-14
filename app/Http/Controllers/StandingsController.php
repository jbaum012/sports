<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Services\UserStatisticService;

class StandingsController extends Controller
{
    public function index()
    {
        $users = User::with('bets')->with('bets.game')->get();
        $data = [];
        $statService = new UserStatisticService();
        foreach ($users as $user) {
            if (count($user->bets) === 0) {
                continue;
            }
            $statService->setUser($user);
            $data[] = ($statService->getUserStats());
        }
        return response()->json($data);
    }
}
