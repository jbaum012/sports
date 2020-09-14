<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class StandingsController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users->sortBy(function ($user, $key) {
            return $user->currentPoints();
        });
        return UserResource::collection($users);
    }
}
