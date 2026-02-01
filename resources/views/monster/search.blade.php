@extends('template.default')

@section('title')
  Résultat de recherche
@endsection

@section('content')
  <h2 class="text-2xl font-bold mb-6">
    Résultats pour : "{{ $query }}"
  </h2>

  @if ($monsters->isEmpty())
    <p class="text-gray-300">Aucun monstre trouvé.</p>
  @else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      @foreach ($monsters as $monster)
        <article class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-xl font-bold">{{ $monster->name }}</h3>
          <p class="text-sm text-gray-300">
            {{ Str::limit($monster->description, 80) }}
          </p>

          <a
            href="{{ route('monster.show', [$monster->id, Str::slug($monster->name)]) }}"
            class="text-red-400 hover:underline"
          >
            Voir le monstre
          </a>
        </article>
      @endforeach
    </div>
  @endif
@endsection
