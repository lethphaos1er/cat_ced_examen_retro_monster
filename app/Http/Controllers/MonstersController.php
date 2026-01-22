<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\View\View;

class MonstersController extends Controller
{
    public function show(Monster $monster): View
    {
        return view('monster.show', compact('monster'));
    }
}