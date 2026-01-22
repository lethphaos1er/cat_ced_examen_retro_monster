<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\MonsterType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class MonstersController extends Controller
{
    public function show(Monster $monster, ?string $slug = null): View
    {
        return view('monster.show', compact('monster'));
    }

    public function create(): View
    {
        $types = MonsterType::query()->orderBy('name')->get();

        // Pas de table "rareties" => on fournit une liste fixe
        $rareties = [
            'Commun',
            'Rare',
            'Épique',
            'Légendaire',
        ];

        return view('monster.create', compact('types', 'rareties'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            // DB: rarity (string) obligatoire
            'rarity' => ['required', 'string', 'max:50'],

            'pv' => ['required', 'integer', 'min:0'],
            'attack' => ['required', 'integer', 'min:0'],
            'defense' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],

            // ton schéma DB a type_id (FK) + rarety_id (typo)
            'type_id' => ['required', 'integer'],
            'rarety_id' => ['nullable', 'integer'],

            // optionnel
            'image_url' => ['nullable', 'string', 'max:255'],
        ]);

        // neutre sans toucher DB
        $data['user_id'] = auth()->id() ?? 1;

        // rarety_id : si non envoyé, valeur neutre
        $data['rarety_id'] = $data['rarety_id'] ?? 1;

        // Image: null si vide
        $data['image_url'] = $data['image_url'] ?: null;

        $monster = Monster::create($data);

        return to_route('monster.show', [
            'monster' => $monster->id,
            'slug' => Str::slug($monster->name),
        ]);
    }
}
