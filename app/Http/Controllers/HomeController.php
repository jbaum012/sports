<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sports = Sport::all();
        return view('home')->with('sports', $sports);
    }
}
