<?php

namespace App\Http\Controllers;

use App\Services\UserStatisticService;
use App\User;
use Illuminate\Http\Request;

class UserStatsController extends Controller
{

    public function show(User $user)
    {
        $statService = new UserStatisticService($user);
        return response()->json($statService->getUserStats());
    }
}
