@extends('template.default')

@section('title')
    Détails du Monstre
@endsection

@section('content')

<!-- Page de détail du monstre -->
<section class="w-full">
  <section class="mb-20">
    <div
      class="bg-gray-700 rounded-lg shadow-lg monster-card"
      data-monster-type="{{ $monster->type->name }}"
    >
      <div class="md:flex">
        <!-- Image du monstre -->
        <div class="w-full md:w-1/2 relative">
          <img
            class="w-full h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none"
            src="{{ asset('images/monster/' . ($monster->image_url ?? 'default.png')) }}"
            alt="{{ $monster->name }}"
          />
          <div class="absolute top-4 right-4">
            <button
              class="text-white bg-gray-400 hover:bg-red-700 rounded-full p-2 transition-colors duration-300"
              style="width:40px;height:40px;display:flex;justify-content:center;align-items:center;"
            >
              <i class="fa fa-bookmark"></i>
            </button>
          </div>
        </div>

        <!-- Détails du monstre -->
        <div class="p-6 md:w-1/2">
          <h2 class="text-3xl font-bold mb-2 creepster">
            {{ $monster->name }}
          </h2>

          <p class="text-gray-300 text-sm mb-4">
            Description détaillée du monstre, y compris son histoire,
            ses capacités, et tout ce qui le rend unique.
          </p>

          <div class="mb-4">
            <div>
              <strong class="text-white">Type:</strong>
              <span class="text-gray-300">{{ $monster->type->name }}</span>
            </div>
            <div>
              <strong class="text-white">PV:</strong>
              <span class="text-gray-300">{{ $monster->pv }}</span>
            </div>
            <div>
              <strong class="text-white">Attaque:</strong>
              <span class="text-gray-300">{{ $monster->attack }}</span>
            </div>
            <div>
              <strong class="text-white">Défense:</strong>
              <span class="text-gray-300">{{ $monster->defense }}</span>
            </div>
          </div>

          <div class="mb-4">
            <span class="text-yellow-400">★★★★☆</span>
            <span class="text-gray-300 text-sm">(4.0/5.0)</span>
          </div>

          <div>
            <a
              href="monster.html"
              class="inline-block text-white bg-red-500 hover:bg-red-700 rounded-full px-4 py-2 transition-colors duration-300"
            >Modifier</a>
            <a
              href="monster.html"
              class="inline-block text-white opacity-60 hover:opacity-100 rounded-full px-4 py-2 transition-colors duration-300"
            >Supprimer</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section d'évaluation -->
  <div class="mt-6">
    <h3 class="text-2xl font-bold mb-4">Évaluez ce Monstre</h3>
    <div id="rating-section" class="flex items-center">
      <span class="rating-star" data-value="1">&#9733;</span>
      <span class="rating-star" data-value="2">&#9733;</span>
      <span class="rating-star" data-value="3">&#9733;</span>
      <span class="rating-star" data-value="4">&#9733;</span>
      <span class="rating-star" data-value="5">&#9733;</span>
    </div>
  </div>

  <script>
    document.querySelectorAll(".rating-star").forEach((star) => {
      star.onclick = function () {
        let rating = this.getAttribute("data-value");
        document.querySelectorAll(".rating-star").forEach((innerStar) => {
          innerStar.getAttribute("data-value") <= rating
            ? innerStar.classList.add("selected")
            : innerStar.classList.remove("selected");
        });
      };
    });
  </script>

  <!-- Section commentaires -->
  <div class="mt-6">
    <h3 class="text-2xl font-bold mb-4">Commentaires</h3>

    <div id="commentaires-section">
      <div class="mb-4 bg-gray-800 rounded p-4">
        <p class="font-bold text-red-400">Utilisateur1</p>
        <p class="text-sm text-gray-400">12/01/2024</p>
        <p class="text-gray-300 mt-2">
          Très intéressant ce monstre, j'aime particulièrement ses capacités spéciales!
        </p>
      </div>

      <div class="mb-4 bg-gray-800 rounded p-4">
        <p class="font-bold text-red-400">Utilisateur2</p>
        <p class="text-sm text-gray-400">13/01/2024</p>
        <p class="text-gray-300 mt-2">
          J'ai eu l'occasion de voir ce monstre en action, et c'était vraiment impressionnant!
        </p>
      </div>
    </div>

    <div class="bg-gray-800 rounded p-4">
      <h4 class="font-bold text-lg text-red-500 mb-2">
        Laissez un commentaire
      </h4>
      <textarea
        class="w-full p-2 bg-gray-900 rounded text-gray-300"
        rows="4"
        placeholder="Votre commentaire..."
      ></textarea>
      <button
        class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full w-full"
      >
        Envoyer
      </button>
    </div>
  </div>
</section>

@endsection
