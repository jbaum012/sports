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
        $users = User::all();
        $data = [];
        foreach ($users as $user) {
            $statService = new UserStatisticService($user);
            $data[] = ($statService->getUserStats());
        }
        return response()->json($data);
    }
}
