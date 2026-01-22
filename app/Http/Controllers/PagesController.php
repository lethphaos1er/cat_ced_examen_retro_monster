<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\Models\monster;


class PagesController extends Controller
{
    public function home()
    {
        $randomMonster = monster::inRandomOrder()->first();
        $lastMonsters = monster::all()->sortByDesc(function ($monster) {
            return $monster->created_at;
        })->take(9);
        return view('pages.home', compact('randomMonster', 'lastMonsters'));
    }
}