@extends('template.default')

@section('title')
  Editer un Monstre
@endsection

@section('content')
  <div class="container mx-auto pb-12">
    <div class="flex flex-wrap justify-center">
      <div class="w-full">
        <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-bold mb-4 text-center creepster">
            Editer un monstre
          </h2>

          <form method="POST" action="{{ route('monster.update', $monster) }}">
            @csrf
            @method('PATCH')

            <!-- Nom -->
            <div>
              <label for="name" class="block mb-1">Nom</label>
              <input
                type="text"
                id="name"
                name="name"
                class="w-full border rounded px-3 py-2 text-gray-700"
                placeholder="Nom du Monstre"
                value="{{ old('name', $monster->name) }}"
                required
              />
            </div>

            <!-- Type -->
            <div>
              <label for="type_id" class="block mb-1">Type</label>
              <select
                id="type_id"
                name="type_id"
                class="w-full border rounded px-3 py-2 text-gray-700"
                required
              >
                <option value="" disabled {{ old('type_id', $monster->type_id) ? '' : 'selected' }}>
                  Choisir un type
                </option>

                @foreach ($types as $type)
                  <option
                    value="{{ $type->id }}"
                    {{ (string) old('type_id', $monster->type_id) === (string) $type->id ? 'selected' : '' }}
                  >
                    {{ $type->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Rareté (STRING en DB: rarity) -->
            <div>
              <label for="rarity" class="block mb-1">Rareté</label>
              <select
                id="rarity"
                name="rarity"
                class="w-full border rounded px-3 py-2 text-gray-700"
                required
              >
                <option value="" disabled {{ old('rarity', $monster->rarity) ? '' : 'selected' }}>
                  Choisir une rareté
                </option>

                @foreach ($rareties as $rarity)
                  <option
                    value="{{ $rarity }}"
                    {{ (string) old('rarity', $monster->rarity) === (string) $rarity ? 'selected' : '' }}
                  >
                    {{ $rarity }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- rarety_id (optionnel) -->
            <input type="hidden" name="rarety_id" value="{{ old('rarety_id', $monster->rarety_id ?? 1) }}" />

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label for="pv" class="block mb-1">PV</label>
                <input
                  type="number"
                  id="pv"
                  name="pv"
                  class="w-full border rounded px-3 py-2 text-gray-700"
                  min="0"
                  placeholder="150"
                  value="{{ old('pv', $monster->pv) }}"
                  required
                />
              </div>

              <div>
                <label for="attack" class="block mb-1">Attaque</label>
                <input
                  type="number"
                  id="attack"
                  name="attack"
                  class="w-full border rounded px-3 py-2 text-gray-700"
                  min="0"
                  placeholder="120"
                  value="{{ old('attack', $monster->attack) }}"
                  required
                />
              </div>

              <div>
                <label for="defense" class="block mb-1">Défense</label>
                <input
                  type="number"
                  id="defense"
                  name="defense"
                  class="w-full border rounded px-3 py-2 text-gray-700"
                  min="0"
                  placeholder="100"
                  value="{{ old('defense', $monster->defense) }}"
                  required
                />
              </div>
            </div>

            <!-- Image (optionnelle) -->
            <div>
              <label for="image_url" class="block mb-1">Image (optionnelle)</label>
              <input
                type="text"
                id="image_url"
                name="image_url"
                class="w-full border rounded px-3 py-2 text-gray-700"
                placeholder="ex: aquadragon.png"
                value="{{ old('image_url', $monster->image_url) }}"
              />
              <p class="text-gray-300 text-sm mt-1">
                Laisse vide pour utiliser l’image par défaut.
              </p>
            </div>

            <!-- Description -->
            <div>
              <label for="description" class="block mb-1">Description</label>
              <textarea
                id="description"
                name="description"
                class="w-full border rounded px-3 py-2 text-gray-700"
                rows="4"
                placeholder="Décris ton monstre..."
                required
              >{{ old('description', $monster->description) }}</textarea>
            </div>

            <div class="flex justify-between items-center">
              <button
                type="submit"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
              >
                Enregistrer
              </button>

              <a
                href="{{ route('monster.show', ['monster' => $monster->id, 'slug' => \Illuminate\Support\Str::slug($monster->name ?? '')]) }}"
                class="text-red-400 hover:text-red-500"
              >
                Annuler
              </a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
