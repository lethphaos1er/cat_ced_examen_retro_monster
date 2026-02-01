<?php

namespace App\Http\Controllers;

use App\Models\Monster;

class PagesController extends Controller
{
    public function home()
    {
        $randomMonster = Monster::inRandomOrder()->first();

        $lastMonsters = Monster::orderByDesc('created_at')
            ->limit(9)
            ->get();

        return view('pages.home', [
            //_main.blade.php pour l'utilisation des variables
            'randomMonster' => $randomMonster,
            'monsters'      => $lastMonsters,
        ]);
    }
}
