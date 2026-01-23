<?php

namespace App\Http\Controllers;

use App\Models\Monster;

class PagesController extends Controller
{
    public function home()
    {
        $randomMonster = Monster::inRandomOrder()->first();

        $monsters = Monster::orderByDesc('created_at')
            ->limit(9)
            ->get();

        return view('pages.home', [
            'randomMonster' => $randomMonster,
            'monsters'      => $monsters,
        ]);
    }
}
