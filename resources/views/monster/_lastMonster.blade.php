<section class="mb-20">
  <h2 class="text-2xl font-bold mb-4 creepster">Derniers monstres ajoutés</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse ($lastMonsters as $monster)
      <article
        class="relative bg-gray-700 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 monster-card"
        data-monster-type="{{ $monster->type_id }}"
      >
        <img
          class="w-full h-48 object-cover rounded-t-lg"
          src="{{ asset('images/monster/' . ($monster->image_url ?? 'default.png')) }}"
          alt="{{ $monster->name }}"
        />

        <div class="p-4">
          <h3 class="text-xl font-bold">{{ $monster->name }}</h3>

          <h4 class="mb-2">
            <a href="#" class="text-red-400 hover:underline">
              {{ $monster->user?->name ?? 'Anonyme' }}
            </a>
          </h4>

          <p class="text-gray-300 text-sm mb-2">
            {{ \Illuminate\Support\Str::limit($monster->description ?? 'Aucune description.', 80) }}
          </p>

          <div class="flex justify-between items-center mb-2">
            <div>
              <span class="text-yellow-400">★★★★☆</span>
              <span class="text-gray-300 text-sm">(4.0/5.0)</span>
            </div>

            <span class="text-sm text-gray-300">
              Type: {{ $monster->type?->name ?? 'Inconnu' }}
            </span>
          </div>

          <div class="flex justify-between items-center mb-4">
            <span class="text-sm text-gray-300">PV: {{ $monster->pv }}</span>
            <span class="text-sm text-gray-300">Attaque: {{ $monster->attack }}</span>
          </div>

          <div class="text-center">
            {{-- <a
              href="{{ route('monster.show', ['monster' => $monster->id, 'slug' => Illuminate\Support\Str::slug($monster->name)]) }}"
              class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
            > --}}
              Plus de détails
            </a>
          </div>
        </div>

        <div class="absolute top-4 right-4">
          <button
            type="button"
            class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
            style="width:40px;height:40px;display:flex;justify-content:center;align-items:center;"
            aria-label="Ajouter aux favoris"
          >
            <i class="fa fa-bookmark" aria-hidden="true"></i>
          </button>
        </div>
      </article>
    @empty
      <p class="text-gray-300">Aucun monstre pour le moment.</p>
    @endforelse
  </div>
</section>
