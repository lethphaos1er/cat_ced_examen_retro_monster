<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \App\Models\monster;


class PagesController extends Controller
{
    public function home()
    {
        $randommonster = monster::inRandomOrder()->first();
        $lastmonsters = monster::all()->sortByDesc(function ($monster) {
            return $monster->created_at;
        })->take(3);
        return view('pages.home', compact('randommonster', 'lastmonsters'));
    }
}