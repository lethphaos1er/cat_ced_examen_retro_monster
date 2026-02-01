<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\MonsterType;
use App\Models\Rarity;
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
        $rareties = Rarity::orderBy('name')->get();

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

    public function edit(Monster $monster): View
    {
        $types = MonsterType::query()->orderBy('name')->get();
        $rareties = Rarity::orderBy('name')->get();

        return view('monster.edit', compact('monster', 'types', 'rareties'));
    }

    public function destroy(Monster $monster): RedirectResponse
    {
        $monster->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Monstre supprimé avec succès');
    }

    public function update(Request $request, Monster $monster): RedirectResponse
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

        $data['rarety_id'] = $data['rarety_id'] ?? 1;
        $data['image_url'] = $data['image_url'] ?: null;

        $monster->update($data);

        return to_route('monster.show', [
            'monster' => $monster->id,
            'slug'    => Str::slug($monster->name),
        ]);
    }

    public function index(): View
    {
        $monsters = Monster::orderBy('name', 'asc')->get();

        return view('monster.index', compact('monsters'));
    }

    public function search(Request $request): View
    {
        $query = Monster::query();

        // Recherche par nom (insensible à la casse)
        if ($request->filled('texte')) {
            $texte = mb_strtolower($request->input('texte'));
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . $texte . '%']);
        }

        // Filtre PV
        if ($request->filled('min_pv') && $request->filled('max_pv')) {
            $query->whereBetween('pv', [
                (int) $request->min_pv,
                (int) $request->max_pv,
            ]);
        }

        // Filtre Attaque
        if ($request->filled('min_attaque') && $request->filled('max_attaque')) {
            $query->whereBetween('attack', [
                (int) $request->min_attaque,
                (int) $request->max_attaque,
            ]);
        }

        // Filtre rareté (si ton select envoie rarity = name)
        if ($request->filled('rarity')) {
            $query->where('rarity', $request->input('rarity'));
        }

        $monsters = $query->orderByDesc('created_at')->get();
        $rareties = Rarity::orderBy('name')->get();

        $queryLabel = $request->filled('texte')
            ? $request->input('texte')
            : 'vos filtres';

        return view('monster.search', [
            'monsters' => $monsters,
            'query'    => $queryLabel,
            'rareties' => $rareties,
        ]);
    }
}
