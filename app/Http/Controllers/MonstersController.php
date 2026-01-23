<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\MonsterType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MonstersController extends Controller
{
    public function show(Monster $monster, ?string $slug = null): View
    {
        return view('monster.show', compact('monster'));
    }

    public function create(): View
    {
        $types = MonsterType::query()->orderBy('name')->get();

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
            'name'        => ['required', 'string', 'max:255'],
            'rarity'      => ['required', 'string', 'max:50'],
            'pv'          => ['required', 'integer', 'min:0'],
            'attack'      => ['required', 'integer', 'min:0'],
            'defense'     => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],

            'type_id'     => ['required', 'integer'],
            'rarety_id'   => ['nullable', 'integer'],

            'image_url'   => ['nullable', 'string', 'max:255'],
        ]);

        $data['user_id'] = Auth::id() ?? 1;
        $data['rarety_id'] = $data['rarety_id'] ?? 1;
        $data['image_url'] = $data['image_url'] ?: null;

        $monster = Monster::create($data);

        return to_route('monster.show', [
            'monster' => $monster->id,
            'slug'    => Str::slug($monster->name),
        ]);
    }
}
